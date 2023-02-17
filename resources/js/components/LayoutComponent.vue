<template>
    <table class="table caption-top">
        <caption>List of users</caption>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users">
            <th scope="row">{{ user.id }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.gender }}</td>
            <td>{{ user.status }}</td>
            <router-link class="btn btn-light border-dark" :to="{ name: 'aboutUser', params: {id: user.id} } ">About</router-link>
            <router-link class="btn btn-light border-dark" :to="{ name:'editUser', params: {id: user.id} }">Edit</router-link>
            <button @click="deleteUser(user.id)" class="btn btn-danger text-body">Delete</button>
        </tr>
        </tbody>
        <router-link to="/create" class="btn btn-dark">Create User</router-link>
    </table>
<!--    <Chat />-->
</template>

<script>
    import AboutComponent from "./AboutComponent.vue";
    import axios from "axios";
    import EditComponent from "./EditComponent.vue";
    import CreateComponent from "./CreateComponent.vue";
    import Chat from "./Chat.vue";

    export default {
        data() {
            return {
                users: []
            }
        },
        components: {Chat, CreateComponent, EditComponent, AboutComponent},
        methods: {
              async getUsers() {
                  this.users = (await axios('/api/')).data.data;
                  console.log(this.users);
              },
              async deleteUser(id) {
                  await axios.delete('/api/delete/' + id);
                  window.location.href = '';
              }
        },
        async mounted() {
            await this.getUsers();
        }
    }
</script>
