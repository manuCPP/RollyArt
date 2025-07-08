<script setup>
  defineProps({
    top: {
      type: String,
      default: '0rem'
    }
  })
</script>

<template>
  <div class="sun-ray"></div>
</template>

<style scoped>
.sun-ray {
  position: fixed;
  top: v-bind(top);
  left: -5rem;
  width: 60vw;
  height: 60px; /* forma stretta per simulare un raggio diretto */
  transform-origin: top left;
  transform: rotate(45deg);
  background: rgba(255, 255, 255, 0.4);

  box-shadow: 0 0 60px 30px rgba(255, 255, 255, 0.2);
  filter: blur(10px);
  pointer-events: none;
  z-index: 1000;
}
</style>
