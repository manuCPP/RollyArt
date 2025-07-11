<script setup>
import { ref, onMounted } from 'vue'

// 🔐 Protezione con password lato client
const isAuthorized = ref(false)
const correctPassword = 'Arte2025' // ✨ Personalizza la password qui

onMounted(() => {
  const risposta = prompt("Inserisci una password")
  if (risposta === correctPassword) {
    isAuthorized.value = true
  } else {
    alert("Accesso negato. Password errata.")
  }
})

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
  isSold: false,
})

function convertToBlob(file) {
  return new Promise((resolve) => {
    const reader = new FileReader()
    reader.onload = () => {
      const img = new Image()
      img.onload = () => {
        const canvas = document.createElement('canvas')
        canvas.width = img.width
        canvas.height = img.height
        canvas.getContext('2d').drawImage(img, 0, 0)
        canvas.toBlob((blob) => {
          resolve(blob)
        }, 'image/jpeg', 0.95)
      }
      img.src = reader.result
    }
    reader.readAsDataURL(file)
  })
}

const buildData = async () => {
  const formToSend = new FormData()
  formToSend.append('title', formData.value.title)
  formToSend.append('author', formData.value.author)
  formToSend.append('dimension', formData.value.dimension)
  formToSend.append('tecnique', formData.value.tecnique)
  formToSend.append('date', formData.value.date)
  formToSend.append('price', formData.value.price)
  formToSend.append('isSold', formData.value.isSold)

  if (selectedFile.value) {
    const blob = await convertToBlob(selectedFile.value)
    formToSend.append('image', blob, 'converted.jpg')
  }

  return formToSend
}

const sendFormData = async () => {
  try {
    const response = await fetch('/api/upload', {
      method: 'POST',
      body: await buildData()
    })
    const text = await response.text()
    console.log('Risposta grezza:', text)
  } catch (error) {
    console.error('Errore durante l’invio:', error)
  }
}
</script>

<template>
  <div v-if="isAuthorized" class="wrapper">
    <form @submit.prevent="sendFormData">
      <h1>Crea una nuova opera</h1>
      <input v-model="formData.title" placeholder="Inserisci un Titolo" type="text">
      <div class="row">
        <input v-model="formData.tecnique" placeholder="Tecnica usata" type="text">
        <input v-model="formData.dimension" placeholder="Dimensione" type="text">
      </div>
      <input v-model="formData.author" placeholder="Inserisci qui l'autore" type="text">
      <div class="row">
        <input v-model="formData.date" placeholder="Inserisci la data" type="text">
        <input v-model="formData.price" placeholder="Inserisci qui il prezzo" type="text">
      </div>
      <div class="row2">
        <input class="imgBtn checkbox" style="width: 2vh; height: 2vh;" type="checkbox" v-model="formData.isSold">
        <label class="imgLabel">Venduto</label>
      </div>
      <div class="row2">
        <button class="imgBtn" type="button" @click="simulateClick">Upload File</button>
        <input @change="handleFileChange" ref="fileInput" type="file" style="display: none;">
        <label class="imgLabel">{{ selectedFile ? selectedFile.name : 'Nessuna immagine' }}</label>
      </div>
      <button type="submit">AGGIUNGI OPERA</button>
    </form>
  </div>

  <div v-else class="wrapper2" style="height: 75vh;">
    <h2>Accesso non autorizzato</h2>
    <p>Ricarica la pagina per riprovare.</p>
  </div>
</template>

<style scoped>
.wrapper {
  padding-block: 5rem;
  background-color: #f5f5f5;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 2rem;
}

.wrapper2 {
  background-color: #f5f5f5;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 88vh !important;
  gap: 1rem;

    h2{
        text-align: center;
        width: 100%;
        color: rgb(190, 188, 188);
        font-size: 2.5rem;
        font-family: Ubuntu, sans-serif;
        font-weight: 300;
    }

    p{
        text-align: center;
        width: 100%;
        color: rgb(86, 86, 86);
        font-size: 1rem;
        font-family: Inter, sans-serif;
        font-weight: 400;
    }

}

form {
  width: 80%;
  padding: 1rem;
  border-radius: 0.5rem;
  background-color: white;
  box-shadow: 0px 4px 8px 2px #dad8d8;
  display: flex;
  flex-direction: column;
  align-items: center;
}

h1 {
  font-family: Inter, sans-serif;
  font-size: 1.5rem;
  color: rgb(0, 0, 47);
}

input {
  margin-top: 1rem;
  width: calc(100% - 2rem);
  height: 5vh;
  padding-inline: 1rem;
  border-radius: 0.5rem;
  border: 1px solid #e2e2e2;
  box-shadow: 0px 2px 4px #f0eded;
}

input[type="checkbox"] {
  accent-color: rgb(0, 0, 47);
}

button {
  margin-top: 2rem;
  width: 100%;
  height: 5vh;
  border-radius: 0.5rem;
  border: 1px solid #d0d0d0;
  box-shadow: 0px 4px 4px #dedede;
  background-color: rgb(0, 0, 47);
  color: white;
  font-family: Inter;
  font-weight: 600;
  transition: 0.2s ease-out;
}

button:hover {
  background-color: rgba(0, 0, 47, 0.85);
  transform: scale(1.025);
  cursor: pointer;
}

.row, .row2 {
  display: flex;
  flex-direction: column;
  width: 100%;
  gap: 0.8rem;
  align-items: center;
}

.row {
  margin-block: 1rem;
}

.imgLabel {
  font-size: 1rem;
  font-weight: 300;
  margin-top: 0;
  color: #878787;
}

.imgBtn {
  margin-top: 1.5rem;
  background-color: white;
  border: 2px solid rgb(0, 0, 47);
  color: rgb(0, 0, 47);
}

@media (min-width: 768px) {
  form {
    width: 50% !important;
    padding: 2rem !important;
  }

  .row {
    flex-direction: row;
  }
}
</style>
