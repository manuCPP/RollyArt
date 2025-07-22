<template>
    <div class="wrapper">
        <form @submit.prevent="sendData" action="">
            <h1>Contattami Qui!</h1>
            <input placeholder="Nome" v-model="formData.name" value="" type="text">
            <input placeholder="Email" v-model="formData.email" type="text">
            <textarea placeholder="A quale opera sei interessato?" v-model="formData.comment" name="" id=""></textarea>
            <button>Submit</button>
        </form>
    </div>
    <div @click="hidePopup" v-show="isPopVisible" class="blackBg">
        <div class="popup">
            <h4>{{ message }}</h4>
            <AkCircleCheckFill v-show="icon" style="width: 6vh; height: 6vh; color: rgb(0, 0, 47);"/>
        </div>
    </div>
</template>


<style scoped>
    .blackBg{
        width: 100vw;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;

        background-color: rgba(0, 0, 0, 0.3);
        z-index: 999;
    }

    .popup{
        position: inherit;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);

        width: 90vw;
        height: 31vh;
        background-color: white;
        border-radius: 2rem;
        box-shadow: 0px 4px 4px rgb(116, 116, 116);

        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 2rem;
        padding: 1rem;
        box-sizing: border-box;
    }

    h4{
        font-family: 'Inter', sans-serif;
        font-size: 1.7rem;
        color: rgb(0, 0, 47);
        font-weight: 600;
        text-align: center;

    }

    .wrapper{
        background-color: #f1f1f1;
        height: 90vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

    }

    form{
        display: flex;
        flex-direction: column;
        gap: 1rem;
        justify-content: center;
        width: 90vw;
        background-color: white;
        box-shadow: 0px 4px 4px rgb(179, 179, 179);
        border-radius: 0.5rem;
        height: auto;
        align-items: center;
        max-width: 600px;

    }

    h1{
        width: 100%;
        text-align: center;
        font-family: Inter, sans-serif;
        font-size: 2.2rem;
        font-weight: 600;
        color: rgb(0, 0, 47);
        padding-top: 1rem;
    }

    input, textarea{
        width: 90% !important;
        box-sizing: border-box;
        height: 6vh;
        background-color: white;
        border: solid 2px rgb(0, 0, 47);
        border-radius: 0.5rem;
        color: rgb(0, 0, 47);
        padding-inline: 1rem;
        font-family: Inter, sans-serif;
        font-size: 1.2rem;
        font-weight: 300;
        text-align: left;


        max-width: 90%;

    }

    textarea{
        height: 15vh;
        padding-block: 1rem;
    }

    button{
        background-color: rgb(0, 0, 47);
        border: none;
        height: 6vh;
        border-radius: 0.5rem;
        font-family: Inter, sans-serif;
        font-size: 1.5rem;
        font-weight: 400;
        color: white;
        width: 90%;
        margin-bottom: 1rem;

        transition: all 0.3s;
    }

    button:hover{
        background-color: rgba(0, 0, 47, 0.8);
        cursor: pointer;
    }

    button:active{
        background-color: rgb(0, 0, 47);
    }

    @media screen and (min-width: 768px){
        form{
            height: 70vh;
            gap: 2rem;


        }

        .popup{
            width: 50vw !important;
            height: 40vh !important;
        }

        h4{
            font-size: 2rem !important;
        }
    }

    @media screen and (min-width: 1024px){
        .popup{
            width: 50vw !important;
            height: 60vh !important;
            padding: 2rem;

            gap: 3rem;
        }

        h4{
            font-size: 2.5rem !important;
        }
    }
</style>


<script setup>
    import { ref } from 'vue'
    import { AkCircleCheckFill } from '@kalimahapps/vue-icons'

    const formData = ref({
        name: '',
        email: '',
        comment: ''
    });

    const sendData = async () => {
        const response = await fetch('/api/contact', {
            method: 'post',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData.value)
        })

        const data = await response.json();
        if(data.message == 'Email inviata!'){
            message.value = 'Email inviata con successo !'
        }
        else{
            message.value = 'Email non inviata!'
            icon.value = false;
        }
        console.log(data);
        showPopup();
    }

    const message = ref('');
    const icon = ref('true');


    const isPopVisible = ref(false);
    const showPopup = () => {
        isPopVisible.value = true;

    }
    const hidePopup = () => {
        isPopVisible.value = false;
    }
</script>
