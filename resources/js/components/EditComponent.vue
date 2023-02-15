<template>
    <div class="container">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" v-model="user.name" class="form-control text-center rounded-4 w-50">
                <div v-if="error.name">
                    <div class="alert alert-danger form-control-sm w-50 mt-1 rounded-5 text-center">{{ error.name }}</div>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" v-model="user.email" class="form-control text-center rounded-4 w-50">
                <div v-if="error.email">
                    <div class="alert alert-danger form-control-sm w-50 mt-1 rounded-5 text-center">{{ error.email }}</div>
                </div>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select v-model="user.gender" class="form-select rounded-4 text-center w-50" aria-label="Default select example">
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <div v-if="error.gender">
                    <div class="alert alert-danger form-control-sm w-50 mt-1 rounded-5 text-center">{{ error.gender }}</div>
                </div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" v-model="user.status" class="form-select rounded-4 text-center w-50" aria-label="Default select example">
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
                <div v-if="error.status">
                    <div class="alert alert-danger form-control-sm w-50 mt-1 rounded-5 text-center">{{ error.status }}</div>
                </div>
            </div>
            <button @click="editUser" class="btn btn-primary w-10 rounded-5">Submit</button>
        </div>
    <button @click="goMainPage" class="btn btn-light">Go back</button>
</template>

<script>
    import axios from "axios";
    import UserService from "../Services/user";

    export default {
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    gender: '',
                    status: '',
                },
                page: 'edit',
                error: {
                    name: null,
                    email: null,
                    gender: null,
                    status: null,
                    isEmailUnique: null,
                },
            }
        },
        props: ['id'],
        methods: {
            async aboutUser() {
                this.user = (await axios.get('/api/about/' + this.id)).data.data;
            },
            goMainPage() {
                this.$router.push('/');
            },
            async editUser() {
                try {
                    await UserService.edit(this.id, this.user, this.error);
                    this.goMainPage();
                } catch (e) {
                    this.error = e.getMessages();
                }
            }
        },
        mounted() {
            this.aboutUser();
        }
    }
</script>
