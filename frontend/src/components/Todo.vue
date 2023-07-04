<template>
    <div class="">
        <div class="todoItem"> {{ title }} </div>
        <div class="deleteButton">X{{ id }}</div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            id: String,
            title: String
        }
    }
</script>