<template>
    <table class="table caption-top">
        <caption>List of users</caption>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Manufacturer</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product in products">
            <th scope="row">{{ product.id }}</th>
            <td>{{ product.name }}</td>
            <td>{{ product.description }}</td>
            <td>{{ product.manufacturer }}</td>
            <td>{{ product.price }}</td>
<!--            <router-link class="btn btn-light border-dark" :to="{ name: 'aboutUser', params: {id: user.id} } ">About</router-link>-->
            <router-link class="btn btn-light border-dark" :to="{ name:'updateProduct', params: {id: product.id} }">Edit</router-link>
            <button @click="deleteProduct(product.id)" class="btn btn-danger text-body">Delete</button>
        </tr>
        </tbody>
    </table>
    <router-link to="/products/create" class="btn btn-dark">Create Products</router-link>
</template>

<script>

export default {
    data() {
        return {
            products: []
        }
    },
    methods: {
        async listOfProducts() {
            this.products = (await axios.get('/api/products')).data.data;
        },
        async deleteProduct(id) {
            await axios.delete('/api/products/' + id);
            window.location.reload();
        }
    },
    async mounted() {
        await this.listOfProducts();
    }
}
</script>
