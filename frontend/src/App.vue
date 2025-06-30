<script setup>
import { RouterLink, RouterView } from 'vue-router'
import NavBar from '@/components/NavBar.vue'

async function getOpere() {
  try {

    const response = await fetch('/api/opere');
    const data = await response.json();
    console.log(data); // Qui hai tutte le opere ricevute
  } catch (error) {
    console.error('Errore durante il fetch:', error);
  }
}

console.log("opere")
getOpere()
</script>

<template>
    <NavBar/>
    <RouterView/>
</template>

<style scoped>

</style>
