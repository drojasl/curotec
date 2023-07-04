<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import Form from './components/Form.vue';
import ListTodo from './components/ListTodo.vue';

</script>

<template>
  <h1>Tasks </h1>
  <Form />
  <ListTodo />
</template>

<style scoped>
</style>
