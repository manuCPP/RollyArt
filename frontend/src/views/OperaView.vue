<template>
    <div class="container">
        <div :class="imgOrientation">
            <img :src="`${backend}/storage/${opera.imgPath}`" width="100%" alt="mario" class="immagine" />
        </div>
        <div class="contenitoreContainer">
            <div class="text">
                <h1>{{ opera.title}}</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit deserunt facilis optio aliquid mollitia debitis ratione architecto? Suscipit, dolore harum.</p>
            </div>

            <div class="cards">
                <SpecsCard :icon="AnOutlinedUser" img="fa-regular fa-user" h1="Autore" :h2="opera.author"/>
                <SpecsCard :icon="AkCalendar" img="fa-regular fa-calendar" h1="Anno" :h2="opera.date"/>
                <SpecsCard :icon="BxPalette" img="fa-regular fa-palette" h1="Tecnica" :h2="opera.tecnique"/>
                <SpecsCard :icon="CaRulerAlt" img="fa-regular fa-user" h1="Dimensioni" :h2="opera.dimension"/>
            </div>


            <div class="priceCard">
                <div class="col">
                    <div class="row">
                        <BsCurrencyEuro class="eur"/>
                        <h2>Prezzo</h2>
                    </div>
                    <h1 style="font-weight: 600; font-family: Inter, sans-serif; color: rgb(0, 0, 41);">{{ `€ ${opera.price}` }}</h1>
                    <h3>Incluso certificato di autenticita'</h3>
                </div>
            </div>
            <button>Contatta per Acquisto</button>
        </div>
    </div>
</template>

<style scoped>
    .container{
        width: 100vw;
        height: auto;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;

        background-color: #f4f4f4;

    }

    .contenitoreContainer{
        width: 100vw;
       display: flex;
       flex-direction: column;
       justify-content: space-evenly;
       align-items: center;
    }

    button{
        background-color: rgb(0, 0, 47);
        width: 90%;
        height: 5vh;
        border: none;
        border-radius: .5rem;
        color: white;
        font-family: Inter, sans-serif;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 2rem;
        margin-top: 1rem;
        max-width: 1340px;
    }

    h1{
        font-family: Inter, sans-serif;
        font-weight: 600;
    }

    p{
        line-height: 1.5;
        font-family: inter, sans-serif;
        padding-block: 1rem;
        color: #5d5d5d;
        max-width: 600px;
    }

    .imgContainer{
        width: 90vw;
        min-height: 30vh;
        max-width: 1340px;
        margin-block: 1rem;

    }

    .imgContainerVertical{
        width: 70vw;

        min-height: 30vh;
        max-width: 1340px;
        margin-block: 3rem;
    }

    img{
        border-radius: 1.5rem;
        box-shadow: 0px 4px 8px 2px rgb(103, 103, 103);
        margin-top: 1rem;
    }

    .text{
        width: 88%;
        max-width: 1340px;
    }

    .cards{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
        max-width: 1340px;
        width: 90%;
        height: 40vh;

    }

    .card{
        width: 100%;
        height: 15%;
        border-radius: 0.5rem;


    }

    .priceCard{
        width: 90%;
        height: 20vh;
        background-color: rgb(235, 235, 235);
        border-radius: 0.7rem;
        border: solid 1px rgb(219, 219, 219);
        padding: 2rem;
        box-sizing: border-box;
        margin-bottom: 1rem;
        max-width: 1340px;
    }

    h3{
        color: rgba(0, 0, 41, 0.76);
        font-family: Inter, sans-serif;
        font-weight: 400;
        font-size: 1rem;
    }

    .col{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;

        gap: 1rem;
    }

    .row{
        display: flex;
        gap: 2rem;
        align-items: center;

        font-family: Inter, sans-serif;
        color: rgb(0, 0, 47);
    }

    h2{
        font-weight: 500;
    }



    .eur{
        text-align: center;
        font-size: 1.5rem;
        color: white;
        background-color: rgb(0, 0, 47);
        padding: 0.5rem;
        border-radius: 0.5rem;
    }

    @media screen and (min-width: 768px){
    .imgContainerVertical{
        width: 50vw;

        min-height: 30vh;
        max-width: 1340px;
        margin-block: 3rem;
    }
    }

    @media screen and (min-width: 1240px){
        .container{
            flex-direction: row;
        }
        .imgContainer, .contenitoreContainer{
            margin-inline: 2rem;
        }
        .imgContainerVertical{
        width: 30vw;

        min-height: 30vh;
        max-width: 1340px;
        margin-block: 3rem;
    }


        button{
            margin-bottom: 0rem;
        }

        .contenitoreContainer{
            width: 50vw;
            padding-block: 2rem;
            background-color: white;
        }
    }

</style>





<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import backend from '@/constants/costants'
import SpecsCard from '@/components/SpecsCard.vue'
import { AnOutlinedUser } from '@kalimahapps/vue-icons'
import { AkCalendar } from '@kalimahapps/vue-icons'
import { BxPalette } from '@kalimahapps/vue-icons'
import { CaRulerAlt } from '@kalimahapps/vue-icons'
import { BsCurrencyEuro } from '@kalimahapps/vue-icons'

const opera = ref({})
const route = useRoute()
const imgOrientation = ref('imgContainer') // Default classe

async function getOpere() {
  try {
    const response = await fetch('/api/opere', {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
    })
    const data = await response.json()
    opera.value = data.find((dato) => dato.id == route.params.id)

    // Dopo aver ottenuto il percorso dell'immagine, analizziamo le sue dimensioni
    const img = new Image()
    img.src = `${backend}/storage/${opera.value.imgPath}`
    img.onload = () => {
      imgOrientation.value = img.width > img.height ? 'imgContainer' : 'imgContainerVertical'
    }
  } catch (error) {
    console.error('Errore durante il fetch:', error)
  }
}

onMounted(() => {
  getOpere()
})
</script>


