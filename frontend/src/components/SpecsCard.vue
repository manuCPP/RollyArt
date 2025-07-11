<script setup>

    const props = defineProps({
        img: String,
        h1: String,
        h2: String,
        icon:Object,
    })
</script>

<template>
    <div class="card">
        <div class="container">
            <component class="img" :is="icon"/>
            <div class="info">
                <h1> {{ props.h1 }} </h1>
                <h2> {{ props.h2 }} </h2>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .card{
        display: flex;
        align-items: center;
        justify-content: flex-start;

        border: solid 1px rgb(227, 225, 225);
        padding-block: 0.5rem;

    }

    .container{
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-left: 1rem;
        width: 100px;



    }

    .info{
        width: 40%;

        display: flex;
        flex-direction: column;
        text-wrap: no-wrap;
        font-family: Inter, sans-serif;
    }

    h1{
        font-size: 0.8rem;
        font-weight: 400;
        color: rgb(89, 89, 89);
        text-wrap: no-wrap;
    }
    h2{
        font-size: 1rem;
        font-weight: 400;
        width: max-content;



    }

    .img{
        background-color: rgb(231, 230, 230);
        padding: 0.6rem;
        color: rgb(0, 0, 0);
        border-radius: 0.5rem;
        width: 2vh;
        height: 2vh;
        text-align: center;


    }


</style>
