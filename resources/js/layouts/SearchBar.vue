<template>
  <div :class="searchBarClass">
    <InputText placeholder="Search" type="text" class="custom-search-input" />
    <div class="search-icon">
      <button @click="search" class="search-button">
        <i class="pi pi-search"></i>
      </button>
    </div>
  </div>
</template>

<script setup>
  import { ref, computed } from 'vue';

  const searchBarFixed = ref(false);

  window.addEventListener('scroll', () => {
    searchBarFixed.value = window.scrollY > 0;
  });

  const searchBarClass = computed(() => ({
    'search-bar': true,
    'search-bar-fixed': searchBarFixed.value,
  }));

  const search = () => {
    // Lógica para realizar la búsqueda
  };
</script>