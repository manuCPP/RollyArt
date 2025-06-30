<script setup>
import Carousel from '@/components/Carousel.vue'
</script>

<template>
    <main>
        <img  src="@/assets/lamp.png" alt="">
        <Carousel/>
    </main>
</template>


<style scoped>
    main{
        /* 8vh is the navbar 2 + 2 vh are the padding of the navbar */
        height: calc(100vh - 11.5vh);
        background-image: url('@/assets/wallMobile.png');
        background-size: cover;
        background-position: center;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }

    img{
        width: 80%;
    }

    @media (min-width: 608px) {
        img{
            width: 40%;
        }
    }

    @media (min-width: 1024px) {
        img{
            width: 20%;
        }
    }
</style>
