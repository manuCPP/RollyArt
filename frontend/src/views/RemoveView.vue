<template>
  <div v-if="isAuthorized" class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>Autore</th>
          <th>Titolo</th>
          <th>Dimensioni</th>
          <th>Tecnica</th>
          <th>Prezzo</th>
          <th>Venduta</th>
          <th>Data</th>
          <th>Rimuovi</th> <!-- Nuova colonna -->
        </tr>
      </thead>
      <tbody>
        <tr v-for="opera in opere" :key="opera.id">
          <td>{{ opera.author }}</td>
          <td>{{ opera.title }}</td>
          <td>{{ opera.dimension }}</td>
          <td>{{ opera.tecnique }}</td>
          <td>{{ opera.price }}€</td>
          <td :class="opera.isSold == 'false' ? 'venduta' : 'non-venduta'">
            {{ opera.isSold == 'true' ? '✅' : '❌' }}
          </td>
          <td>{{ opera.date }}</td>
          <td>
            <button class="remove-btn" @click="rimuoviOpera(opera.id)">🗑️</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div v-else class="wrapper2" style="height: 75vh;">
    <h2>Accesso non autorizzato</h2>
    <p>Ricarica la pagina per riprovare.</p>
  </div>
</template>
<style scoped>


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

.table-wrapper {
  width: 100%;
  padding-block: 2rem;
  max-width: 100vw;
  overflow-x: auto;
  padding-inline: 0.5rem;
  box-sizing: border-box;
}


table {
  width: 100%;
  border-collapse: collapse;
  font-family: Inter, sans-serif;
  font-size: 0.9rem;
  background-color: white;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  border-radius: 8px;


}

th, td {
  padding: 0.7rem;
  text-align: left;
  border-bottom: 1px solid #ddd;
  white-space: nowrap;
}

th {
  background-color: #00002f;
  color: white;
  position: sticky;
  top: 0;
  z-index: 1;
}

.venduta {
  color: green;
  font-weight: bold;
}

.non-venduta {
  color: red;
  font-weight: bold;
}

@media screen and (max-width: 600px) {
  table {
    font-size: 0.75rem;
  }

  th, td {
    padding: 0.4rem;
  }
}
</style>




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

const opere = ref([]);

const getData = async () => {
    const response = await fetch('/api/opere');
    const data = await response.json();
    opere.value = await data;
    console.log(data)
}

const rimuoviOpera = async (id) => {
  try {
    const response = await fetch(`/api/opera/${id}`, {
      method: 'DELETE',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      }
    });

    if (!response.ok) throw new Error('Errore nella rimozione');

    opere.value = opere.value.filter(opera => opera.id !== id);
    alert('Opera rimossa!');
  } catch (error) {
    console.error(error);
    alert('Errore nella rimozione dell\'opera.');
  }
};

getData()
</script>
