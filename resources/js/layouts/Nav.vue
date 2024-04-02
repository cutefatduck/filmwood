<template>
  <div class="sticky-menu">
    <Menubar :model="visibleItems">
      <template #start>
        <router-link to="/">
          <img src="/images/logo.svg" alt="Filmwood Logo" class="logo" />
        </router-link>
      </template>
      <template #item="{ item, props, hasSubmenu, root }">
        <a v-ripple class="flex align-items-center" v-bind="props.action" @click="redirectToRandomView(item)" :href="item.to">
          <span :class="item.icon" />
          <span class="ml-2">{{ item.label }}</span>
          <Badge v-if="item.badge" :class="{ 'ml-auto': !root, 'ml-2': root }" :value="item.badge" />
          <span v-if="item.shortcut" class="ml-auto border-1 surface-border border-round surface-100 text-xs p-1">{{ item.shortcut }}</span>
          <i v-if="hasSubmenu" :class="['pi pi-angle-down', { 'pi-angle-down ml-2': root, 'pi-angle-right ml-auto': !root }]"></i>
        </a>
      </template>
      <template #end>
        <div class="flex align-items-center gap-2">
          <template v-if="!user?.name">
            <template v-if="$route.name !== 'auth.login'">
              <li class="nav-item">
                <router-link class="nav-boton nav-link" to="/login">
                  {{ $t('login') }}
                </router-link>
              </li>
            </template>
            <template v-if="$route.name !== 'auth.register'">
              <li class="nav-item">
                <router-link class="nav-boton nav-link" to="/register">
                  {{ $t('register') }}
                </router-link>
              </li>
            </template>
          </template>
          <template v-if="user?.name" class="nav-item dropdown">
            <div class="username-dropdown">
                <span class="mr-2 username">{{ user.name }}</span>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><router-link class="dropdown-item" to="/admin">Admin</router-link></li>
                    <li><router-link to="/admin/media" class="dropdown-item">Media</router-link></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" @click="logout">Cerrar sesión</a></li>
                </ul>
            </div>
          </template>
        </div>
      </template>
    </Menubar>
  </div>
</template>

<script setup>
  import { ref, computed } from 'vue';
  import { useStore } from "vuex";
  import useAuth from "@/composables/auth";
  import { useRouter } from "vue-router";

  const router = useRouter();
  const store = useStore();
  const user = computed(() => store.getters["auth/user"]);
  const { processing, logout } = useAuth();

  // Define los elementos del menú
  const getItems = () => {
    if (user.value) {
      return [
        {
          label: 'HOME',
          to: '/'
        },
        {
          label: 'PELICULAS',
          to: 'admin/media'
        },
        {
          label: 'SERIES',
          to: 'admin/media'
        },
        {
          label: 'RANDOM',
          action: redirectToRandomView
        }
      ];
    } else {
      return [];
    }
  };

  // Función para obtener los elementos del menú dependiendo del estado de autenticación del usuario
  const visibleItems = ref(getItems());

  // Esta función maneja el redireccionamiento a una vista aleatoria
  function redirectToRandomView() {
    const vistas = [
      'admin/categories',
      'admin/media',
      'admin/permissions',
      'admin/posts',
      'admin/users',
      'admin/roles',
    ];
    const randomIndex = Math.floor(Math.random() * vistas.length);
    const randomView = vistas[randomIndex];
    router.push(randomView);
  }
</script>
