<script setup>
import { ref } from 'vue'
import { useWindowSize } from '@vueuse/core'

const { width } = useWindowSize()
const isActive = ref(false);

const toggleMenu = () =>{
    isActive.value = !isActive.value;
    console.log(isActive.value);
}
</script>


<template>
    <nav>
        <h1>RollyArt</h1>
        <div v-show="width < 767" :class="`menu-wrap ${isActive ? 'open' : ''}`">
            <button @click="toggleMenu()"><img style="background-color: transparent;" src="@/assets/menu.png" width="100%" height="100%" alt=""></button>
            <RouterLink to="/" v-show="isActive" class="link">Home</RouterLink>
            <RouterLink to="/add" v-show="isActive" class="link">About</RouterLink>
            <RouterLink to="/sold" v-show="isActive" class="link">Sold</RouterLink>
            <RouterLink v-show="isActive" class="link">Contact</RouterLink>
        </div>

        <div v-show="width > 767" class="normalNav">
            <RouterLink to="/" class="normalLink">Home</RouterLink>
            <RouterLink to="/add" class="normalLink">About</RouterLink>
            <RouterLink to="/sold" class="normalLink">Sold</RouterLink>
            <RouterLink class="normalLink">Contact</RouterLink>
        </div>
    </nav>
</template>


<style scoped>
    .normalNav{

        height: 100%;
        width: 45vw;


        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .normalLink{
        font-family: Inter;
        font-size: 1rem;
        text-decoration: none;
        color: rgb(49, 49, 49);
        transition: 0.2s ease-out;
    }

    .normalLink:hover{
        scale: 1.05;
        color: black;
        font-weight: 500;
        cursor: pointer;

    }

    .normalLink:nth-child(4){
        border: solid 2px black;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        transition: 0.5s ease-out;
    }

    .normalLink:nth-child(4):hover{
        background-color: black;
        color: white;
        font-weight: 500;
        scale: 1.1;
        cursor: pointer;
    }



    .link{
        width: 100%;
        height: 4vh;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        /*border-top: solid 1px rgb(196, 196, 196);*/
        margin-block: 1rem;


        text-decoration: none;
        color: black;
        font-family: sans-serif;
    }

    .link:hover{
        background-color: rgb(219, 216, 216);
    }

    .open{
        width: 30vw;
        height: 100vh;
        position: absolute;
        top: 0;
        right: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        padding: 2rem;
        padding-top: 2.5rem;
        button{
            margin-bottom: 2rem;
        }

        background-color: rgb(239, 239, 239) !important;
    }

    .menu-wrap{
        background-color: transparent;
        transition: 0.3 ease-out;
    }

    nav{
        height: 8vh;


        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 1rem;
    }

    button{
        border: none;
        height: 2vh;
        width: 2vh;
        background-color: transparent;


    }

    button:hover{
        background-color: gray;
        cursor: pointer;
    }

    button:active{

    background: #0056b3;
    transform: scale(0.97);
    }

    h1{
        font-family: Ubuntu;
        font-size: 2rem;
        font-weight: 500;
    }
</style>
