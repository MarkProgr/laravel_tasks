<template>
    <div class="container text-center" v-if="user">
        <h2 class="col align-self-center mb-4 mt-5">{{ user.name }}</h2>
        <p class="col align-self-center mb-4">Email:{{ user.email }}</p>
        <p class="col align-self-center mb-4">Gender: {{ user.gender }}</p>
        <p class="col align-self-center">Status: {{ user.status }}</p>
    </div>
    <button @click="goMainPage" class="btn btn-light">Go back</button>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            user: {},
        }
    },
    props: ['id'],
    methods: {
        async getUser() {
            this.user = (await axios.get('/api/about/' + this.id)).data.data;
        },
        goMainPage() {
            this.$router.push('/');
        }
    },
    async mounted() {
        await this.getUser()
    }
}

</script>
