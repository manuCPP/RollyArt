<script setup>
import { ref } from 'vue'

const fileInput = ref(null)
const selectedFile = ref(null)

const simulateClick = () => {
  fileInput.value.click()
}

const handleFileChange = (event) => {
  const file = event.target.files[0]
  if (file) {
    selectedFile.value = file
    console.log("File selezionato:", file)
  }
}

const formData = ref({
  title: '',
  author: '',
  dimension: '',
  tecnique: '',
  date: '',
  price: '',
})

const buildData = () => {
  const formToSend = new FormData()
  formToSend.append('title', formData.value.title)
  formToSend.append('author', formData.value.author)
  formToSend.append('dimension', formData.value.dimension)
  formToSend.append('tecnique', formData.value.tecnique)
  formToSend.append('date', formData.value.date)
  formToSend.append('price', formData.value.price)

  if (selectedFile.value) {
    formToSend.append('image', selectedFile.value)
  }

  return formToSend
}

const sendFormData = async () => {
  try {
    const response = await fetch('/api/upload', {
      method: 'POST',
      body: buildData()
    })

    const text = await response.text()
console.log('Risposta grezza:', text)

    
  } catch (error) {
    console.error('Errore durante l’invio:', error)
  }
}
</script>

<template>
    <div class="wrapper">

        <form @submit.prevent="sendFormData" style="width: 80%; padding: 1rem; border-radius: 0.5rem; background-color: white; box-shadow: 0px 4px 8px 2px #dad8d8; display: flex; flex-direction: column; align-items: center;">
            <h1>Crea una nuova opera</h1>
            <input v-model="formData.title" placeholder="Inserisci un Titolo" type="text">
            <div class="row">
                <input v-model="formData.tecnique" placeholder="Tecnica usata" type="text">
                <input v-model="formData.dimension" placeholder="Dimensione" type="text">
            </div>
            <input v-model="formData.author" placeholder="Inserisci qui L'autore" type="text">
            <div class="row">
                <input v-model="formData.date" placeholder="Inserisci la data" type="text">
                <input v-model="formData.price" placeholder="Inserisci qui il prezzo" type="text">
            </div>

            <div class="row">
                <button type="button" @click="simulateClick" style="color: rgb(18, 95, 238); background-color: white; width: 50%;" >Upload File</button>
                <input @change="handleFileChange" ref="fileInput" type="file" style="display: none;">
                <label for="">No file chosen</label>
            </div>


            <button type="submit">AGGIUNGI OPERA</button>
        </form>


    </div>
</template>

<style scoped>
    h1{
        font-family: Inter, sans-serif;
        font-size: 1.5rem;
    }

    label{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 2rem;
        width: 50%;
        height: 4vh;



        color: rgb(135, 135, 135);

        font-family: Inter;
        font-size: 1rem;

        font-weight: 400;
        transition: 0.2s ease-out;
    }

    .row{
        display: flex;
        align-items: center;
        width: 100%;
    }

    .wrapper{
        height: 88.5vh;
        background-color: #f5f5f5;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 2rem;
    }

    input{
        margin-top: 2rem;
        width: calc(100% - 2rem);
        height: 4vh;
        padding-inline: 1rem;
        border-radius: 2rem;
        border: solid 1px rgb(208, 208, 208);
        box-shadow: 0px 4px 4px #dedede;
    }

    button{
        margin-top: 2rem;
        width: calc(100% );
        height: 4vh;
        padding-inline: 1rem;
        border-radius: 2rem;
        border: solid 1px rgb(208, 208, 208);
        box-shadow: 0px 4px 4px #dedede;
        background-color: rgb(18, 95, 238);

        font-family: Inter;
        font-size: 1rem;
        color: white;
        font-weight: 600;
        transition: 0.2s ease-out;
    }

    button:hover{
        background-color: rgba(18, 95, 238, 0.845);
        scale: 1.025;
        cursor: pointer;
    }


</style>
