<template>
    <div class="wrapper">
        <form action="">
            <h1>Contattami Qui!</h1>
            <input placeholder="Nome" value="" type="text">
            <input placeholder="Email" type="text">
            <textarea placeholder="Commento" name="" id=""></textarea>
            <button>Submit</button>
        </form>
    </div>

</template>


<style scoped>
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
        padding: 1rem;
        background-color: white;
        box-shadow: 0px 4px 4px rgb(179, 179, 179);
        border-radius: 0.5rem;
        height: auto;
        align-items: center;

    }

    h1{
        width: 100%;
        text-align: center;
        font-family: Inter, sans-serif;
        font-size: 2.2rem;
        font-weight: 600;
        color: rgb(0, 0, 47);
        padding-block: 1rem;
    }

    input, textarea{
        width: 85vw;
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


        max-width: 80%;

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
        font-size: 2rem;
        font-weight: 500;
        color: white;
        width: 80%;
        margin-bottom: 1rem;
    }

    @media screen and (min-width: 768px){
        form{
            height: 70vh;
            gap: 2rem;


        }
    }
</style>


<script setup>

</script>
