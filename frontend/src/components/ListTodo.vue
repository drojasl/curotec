<template>
    <TodoItem />
    <div v-for="todo in todos" :key="todo.id">
        <div class="todoItem"> {{ todo.title }} </div>
        <span class="deleteButton" onclick="deleteItem()">X</span>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                todos: [],
                apiUrl: "http://127.0.0.1:8000/api/"
            }
        },
        methods: {
            loadTodos() {
                // TODO: Put API urls as constant
                axios.get(`${this.apiUrl}todo/`)
                    .then(response => {
                        this.todos = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            deleteItem(id) {
                conosole.log(id);
            }
        },
        mounted() {
            this.loadTodos();
        }
    }
</script>