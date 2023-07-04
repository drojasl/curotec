<template>
    <div class="">

        <form method="POST" v-on:submit.prevent="createTodoHandler()">
            <div class="">
                <input
                class=""
                type="text"
                placeholder="Enter Todo"
                name="title"
                v-model="title"
                required
                >
                <span class="text-red-500">*</span>

                <input type="submit" value="Add" class="">
                <br>
                <div class="" v-if="serverError">{{ serverError }}</div>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                title: "",
                apiUrl: "http://127.0.0.1:8000/api/"
            }
        },
        methods: {
            createTodoHandler() {
                this.serverError = "";
                if(this.valideForm()) {
                    // TODO: Put API urls as a constant
                    axios.post(`${this.apiUrl}todo`, {
                        title: this.title
                    })
                    .then(response => {
                        if(response?.data?.message === 'Todo saved succesfully') {
                            this.title = "";
                        }
                    })
                    .catch(error => {
                        const serverMessage = error?.response?.data?.message;
                        switch (serverMessage) {
                            case "Error validating the input data":
                                this.serverError = error?.response?.data?.error;
                                break;
                            case "Error saving in database":
                                this.serverError = serverMessage;
                                if (error?.response?.data?.error.includes("UNIQUE constraint failed: Todos.email")) {
                                    this.serverError = "The email is already registered";
                                }
                                break;
                            case "Error sending the email":
                                this.serverError = "The Todo was created. But there was an issue trying to notify to the support email";
                                break;
                            default:
                                this.serverError = serverMessage;
                                console.log(error);
                                break;
                        }
                    });
                }
            },
            valideForm() {
                // title
                if (!this.title) {
                    return true;
                }
                return true;
            }
        }
    }
</script>