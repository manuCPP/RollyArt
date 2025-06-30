<template>
  <div class="carousel">
    <div class="carousel-track" ref="track">
      <img
        v-for="(img, index) in images"
        :key="index"
        :src="img"
        :alt="'img' + index"
      />
    </div>

    <div class="carousel-thumbnails" ref="thumbs">
      <div class="thumb-wrapper">
        <img
          v-for="(img, index) in images"
          :key="'thumb-' + index"
          :src="img"
          :alt="'thumb' + index"
          @click="scrollTo(index)"
          :class="{ active: currentIndex === index }"
          ref="thumbRefs"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, nextTick } from 'vue'

const images = [
  new URL('@/assets/img1.png', import.meta.url).href,
  new URL('@/assets/img2.png', import.meta.url).href,
  new URL('@/assets/img3.png', import.meta.url).href,
  new URL('@/assets/img1.png', import.meta.url).href,
  new URL('@/assets/img2.png', import.meta.url).href,
  new URL('@/assets/img3.png', import.meta.url).href,
  new URL('@/assets/img1.png', import.meta.url).href,
  new URL('@/assets/img2.png', import.meta.url).href,
  new URL('@/assets/img3.png', import.meta.url).href,
]

const track = ref(null)
const thumbs = ref(null)
const thumbRefs = ref([])
const currentIndex = ref(0)

function scrollTo(index) {
  const imgEl = track.value?.children[index]
  if (imgEl) {
    imgEl.scrollIntoView({ behavior: 'smooth', inline: 'center' })
    currentIndex.value = index
  }
}

watch(currentIndex, async (newIndex) => {
  await nextTick()
  const thumb = thumbRefs.value[newIndex]
  const container = thumbs.value
  if (thumb && container) {
    const offset = thumb.offsetLeft + thumb.clientWidth / 2 - container.clientWidth / 2
    container.scrollTo({ left: offset, behavior: 'smooth' })
  }
})

</script>

<style scoped>
.carousel {
  width: 100%;
  overflow-x: auto;
  overflow-y: hidden;
  scroll-behavior: smooth;
  padding: 1rem;

  height: 50vh;
  scrollbar-width: none;
  scroll-snap-type: x mandatory;

}

.carousel-track {
  display: flex;
  align-items: center;
  gap: 1rem;
  min-width: max-content;
  height: 100%;
}

.carousel-track img {
  height: 95%;
  padding-inline: 1rem;
  flex-shrink: 0;
  border-radius: 8px;
  object-fit: cover;
  scroll-snap-align: center;
}

/* Miniature */
.carousel-thumbnails {
  position: fixed;
  bottom: 2rem; /* distanza dal bordo inferiore */
  left: 50%;
  transform: translateX(-50%);
  display: block;
  width: 80vw;
  background-color: rgba(255, 255, 255, 0.95);
  box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  overflow-x: auto;
  scrollbar-width: none;
  padding-inline: 1rem; /* padding laterale */
  border-radius: 8px;

}

.carousel-thumbnails::-webkit-scrollbar {
  display: none;
}


.thumb-wrapper {

  display: flex;
  gap: 1rem;
  width: max-content;
  padding: 1rem;
  margin: 0 auto;

}

.thumb-wrapper img {
  width: 60px;
  height: 40px;
  object-fit: cover;
  border-radius: 4px;
  cursor: pointer;
  opacity: 0.6;
  transition: opacity 0.3s, transform 0.3s;
  flex-shrink: 0;
}

.thumb-wrapper img.active {
  opacity: 1;
  transform: scale(1.05);
  border: 2px solid #333;
}
</style>
