<script setup>
import { ref } from 'vue'
import { useWindowSize } from '@vueuse/core'

const { width } = useWindowSize()
const isMenuOpen = ref(false)

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value
}

const closeMenu = () => {
  isMenuOpen.value = false
}
</script>

<template>
  <nav class="navbar">
    <h1 class="brand">RollyArt</h1>

    <!-- Bottone menu mobile -->
    <button v-if="width < 767" class="menu-btn" @click="toggleMenu">
      <img src="@/assets/menu.png" alt="Menu" />
    </button>

    <!-- Overlay + menu mobile -->
    <transition name="fade-slide">
      <div v-show="isMenuOpen" class="mobile-wrapper">
        <div class="overlay" @click="closeMenu"></div>
        <div class="mobile-menu">
          <RouterLink to="/" class="mobile-link" @click="closeMenu">Home</RouterLink>
<!--           <RouterLink to="/add" class="mobile-link" @click="closeMenu">About</RouterLink>
 -->          <RouterLink to="/sold" class="mobile-link" @click="closeMenu">Sold</RouterLink>
          <RouterLink to="/contact" class="mobile-link" @click="closeMenu">Contact</RouterLink>
        </div>
      </div>
    </transition>

    <!-- Menu desktop -->
    <div v-show="width >= 767" class="desktop-menu">
      <RouterLink to="/" class="nav-link">Home</RouterLink>
<!--       <RouterLink to="/add" class="nav-link">About</RouterLink>
 -->      <RouterLink to="/sold" class="nav-link">Sold</RouterLink>
      <RouterLink to="/contact" class="nav-link contact">Contact</RouterLink>
    </div>
  </nav>
</template>

<style scoped>
.navbar {
  position: relative;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  height: 8vh;
  background-color: white;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
  z-index: 300;
}

.brand {
  font-family: 'Ubuntu', sans-serif;
  font-size: 2rem;
  font-weight: 500;
  color: #333;
}

.menu-btn {
  background: none;
  border: none;
  width: 1.5rem;
  height: 1.5rem;
  cursor: pointer;
  z-index: 350;
}

.menu-btn img {
  width: 100%;
  height: 100%;
}

.mobile-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: flex-end;
  z-index: 250;
}

.overlay {
  position: absolute;
  width: 100vw;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.3);
  z-index: 200;
}

.mobile-menu {
  width: 70vw;
  height: 100vh;
  background-color: rgba(255, 255, 255, 0.96);
  box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  padding: 2rem;
  z-index: 300;
  animation: slideIn 0.3s ease-out;
}

.mobile-link {
  margin: 0 4rem 1rem 0;
  font-family: 'Inter', sans-serif;
  font-size: 1.2rem;
  color: #333;
  text-decoration: none;
  border-bottom: 1px solid #eee;
  padding-block: 0.5rem;
  transition: all 0.3s;
}

.mobile-link:hover {
  color: #000;
  background-color: rgba(130, 130, 130, 0.1);
}

.desktop-menu {
  display: flex;
  align-items: center;
  gap: 2.5rem;
}

.nav-link {
  font-family: 'Inter', sans-serif;
  font-size: 1rem;
  text-decoration: none;
  color: #333;
  transition: all 0.3s ease;
}

.nav-link:hover {
  color: #000;
  transform: scale(1.05);
}

.contact {
  border: 2px solid #000;
  padding: 0.5rem 1rem;
  border-radius: 2rem;
  font-weight: 600;
}

.contact:hover {
  background-color: #000;
  color: #fff;
  transform: scale(1.1);
}

/* Transizioni */
.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: opacity 0.3s ease, transform 0.3s ease;
}
.fade-slide-enter-from,
.fade-slide-leave-to {
  opacity: 0;
  transform: translateX(100%);
}

@keyframes slideIn {
  from {
    transform: translateX(100%);
  }
  to {
    transform: translateX(0);
  }
}
</style>
