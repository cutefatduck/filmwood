<template>
  <div class="sticky-menu">
    <Menubar :model="items">
      <template #start>
        <svg width="35" height="40" viewBox="0 0 35 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-2rem">
          <path d="..." fill="var(--primary-color)" />
          <path d="..." fill="var(--text-color)" />
        </svg>
      </template>
      <template #item="{ item, props, hasSubmenu, root }">
        <a v-ripple class="flex align-items-center" v-bind="props.action" @click="redirectToRandomView(item)" :href="item.to">
          <span :class="item.icon" />
          <span class="ml-2">{{ item.label }}</span>
          <Badge v-if="item.badge" :class="{ 'ml-auto': !root, 'ml-2': root }" :value="item.badge" />
          <span v-if="item.shortcut" class="ml-auto border-1 surface-border border-round surface-100 text-xs p-1">{{ item.shortcut }}</span>
          <i v-if="hasSubmenu" :class="['pi pi-angle-down', { 'pi-angle-down ml-2': root, 'pi-angle-right ml-auto': !root }]"></i>
          <template v-if="!user?.name">
      </template>
        </a>
      </template>
      <template #end>
        <div class="flex align-items-center gap-2">
          <InputText placeholder="Search" type="text" class="w-8rem sm:w-auto" />
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
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <Avatar label="P" class="mr-2" size="large" />
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><router-link class="dropdown-item" to="/admin">Admin</router-link></li>
              <li><router-link to="/admin/media" class="dropdown-item">Media</router-link></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a></li>
            </ul>
          </template>
        </div>
      </template>
    </Menubar>
  </div>
</template>

<script setup>
  import { useStore } from "vuex";
  import { ref } from "vue";
  import useAuth from "@/composables/auth";
  import { computed } from "vue";
  import { useRouter } from "vue-router";

  const router = useRouter(); 
  const store = useStore();
  const user = computed(() => store.getters["auth/user"]);
  const { processing, logout } = useAuth();

  const vistas = [
    'admin/categories',
    'admin/media',
    'admin/permissions',
    'admin/posts',
    'admin/users',
    'admin/roles',
  ];

  const getRandomView = () => {
    const randomIndex = Math.floor(Math.random() * vistas.length);
    return vistas[randomIndex];
  };

  function redirectToRandomView() {
    const randomView = getRandomView();
    router.push(randomView); 
  }
  const items = ref([
    {
      label: 'Home',
      to: '/'
    },
    {
      label: 'Peliculas',
      to: 'admin/media'
    },
    {
      label: 'Series',
      to: 'admin/media'
    },
    {
      label: 'Random',
      action: redirectToRandomView 
    }
  ]);

</script>