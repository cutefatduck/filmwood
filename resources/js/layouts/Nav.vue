<template>
  <div class="sticky-menu">
    <Menubar :model="items">
      <template #start>
        <router-link to="/">
          <img src="/images/logo.svg" alt="Filmwood Logo" class="logo" />
        </router-link>
      </template>
      <template #item="{ item, props, hasSubmenu, root }">
        <a :class="{ 'active-link': $route.path === item.to }" class="flex align-items-center" v-bind="props.action" :href="item.to">
          <span class="ml-2">{{ item.label }}</span>
          <!-- <Badge v-if="item.badge" :class="{ 'ml-auto': !root, 'ml-2': root }" :value="item.badge" /> -->
          <span v-if="item.shortcut" class="ml-auto border-1 surface-border border-round surface-100 text-xs p-1">{{ item.shortcut }}
          </span>
          <i v-if="hasSubmenu" :class="['pi pi-angle-down', { 'pi-angle-down ml-2': root, 'pi-angle-right ml-auto': !root }]"></i>
        </a>
      </template>
      <template #end>
        <AppSearchBar :class="{ 'search-bar': isHomePage, 'search-bar-fixed': !isHomePage }" />
        <div class="flex align-items-center gap-2">
          <template v-if="user?.name">
            <li class="nav-item lista">
              <router-link class="nav-boton" to="/user/saved" >Mi lista</router-link>
            </li>
          </template>
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
                <li><router-link class="dropdown-item" to="/user/perfil" >Perfil</router-link></li>
                <li><router-link class="dropdown-item" to="/admin">Admin</router-link></li>
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
  import { useGetMedia } from '@/composables/media';
  import AppSearchBar from '@/layouts/SearchBar.vue';

  const isHomePage = computed(() => router.currentRoute.value.name === 'home');

  const { randomMedia,  fetchRandomMedia } = useGetMedia();
  const router = useRouter();
  const store = useStore();
  const user = computed(() => store.getters["auth/user"]);
  const { logout } = useAuth();

  const items = ref([
    {
      label: 'HOME',
      to: '/'
    },
    {
      label: 'PELICULAS',
      to: '/media/peliculas'
    },
    {
      label: 'SERIES',
      to: '/media/series'
    },
    {
      label: 'RANDOM',
      command: () => redirectToRandomView() 
    }
  ]);

  // Esta función maneja el redireccionamiento a una vista aleatoria de película o serie
  async function redirectToRandomView() {
    fetchRandomMedia().then(() => {
      if (randomMedia.value) {
        router.push({ name: 'media.view', params: { id: randomMedia.value.id.toString() } });
      } else {
        console.error('No se encontraron datos de media shows disponibles.');
      }
    }).catch((error) => {
      console.error('Error al consultar la base de datos:', error);
    });
  }

</script>