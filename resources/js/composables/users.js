import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import Swal from 'sweetalert2'

export function useGetUser() {
    const Getusers = ref([]);
    const loading = ref(false);
    const userId = ref(null);
  
    const fetchUser = async () => {
      try {
        loading.value = true;
        const response = await axios.get('/api/user');
        Getusers.value = response.data;
        userId.value = response.data.id;
      } catch (error) {
        console.error('Error fetching user:', error);
      } finally {
        loading.value = false;
      }
    };
  
    const fetchUserById = async (id) => {
      try {
        loading.value = true;
        const response = await axios.get(`/api/user/${id}`);
        Getusers.value = response.data; // Asignamos el resultado a un array para mantener la consistencia con la lista de users
        userId.value = response.data.id;
    } catch (error) {
        console.error(`Error fetching user with ID ${id}:`, error);
      } finally {
        loading.value = false;
      }
    };
  
    return { Getusers, loading, fetchUser, fetchUserById };
}

export function useUsers() {
    const users = ref([])
    const user = ref({
        name: ''
    })

    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getUsers = async (
        page = 1,
        search_id = '',
        search_title = '',
        search_global = '',
        order_column = 'created_at',
        order_direction = 'desc'
    ) => {
        axios.get('/api/users?page=' + page +
            '&search_id=' + search_id +
            '&search_title=' + search_title +
            '&search_global=' + search_global +
            '&order_column=' + order_column +
            '&order_direction=' + order_direction)
            .then(response => {
                users.value = response.data;
            })
    }

    const getUser = async (id) => {
        axios.get('/api/users/' + id)
            .then(response => {
                user.value = response.data.data;
            })
    }

    const storeUser = async (user) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        let serializedPost = new FormData()
        for (let item in user) {
            if (user.hasOwnProperty(item)) {
                serializedPost.append(item, user[item])
            }
        }

        axios.post('/api/users', serializedPost)
            .then(response => {
                router.push({name: 'users.index'})
                swal({
                    icon: 'success',
                    title: 'User saved successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const updateUser = async (user) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        axios.put('/api/users/' + user.id, user)
            .then(response => {
                router.push({name: 'users.index'})
                swal({
                    icon: 'success',
                    title: 'User updated successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const deleteUser = async (id) => {
        try {
            const result = await Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            });
            if (result.isConfirmed) {
                const response = await axios.delete(`/api/users/${id}`);
                Swal.fire({
                    icon: 'success',
                    title:'¡Tu cuenta se ha eliminado!', 
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        } catch (error) {
            console.log(error)
            Swal.fire({
                icon: 'error',
                title:'¡Tu cuenta no ha podido eliminarse!', 
                showConfirmButton: false,
                timer: 1500
            })
        }
    }

    return {
        users,
        user,
        getUsers,
        getUser,
        storeUser,
        updateUser,
        deleteUser,
        validationErrors,
        isLoading
    }
}