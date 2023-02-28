<template>
    <div class="container">
        <div class="mb-3">
            <label for="name" class="form-label">Name of product</label>
            <input type="text" v-model="product.name" class="form-control text-center rounded-4 w-50">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" v-model="product.description" class="form-control text-center rounded-4 w-50">
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Manufacturer</label>
            <input type="text" v-model="product.manufacturer" class="form-control text-center rounded-4 w-50">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Release Date</label>
            <input type="text" v-model="product.release_date" class="form-control text-center rounded-4 w-50">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" v-model="product.price" class="form-control text-center rounded-4 w-50">
        </div>
        <button @click="createProduct" class="btn btn-primary w-10 rounded-5">Submit</button>
    </div>
</template>

<script>

export default {
    data() {
        return {
            product: {
                name: null,
                description: null,
                manufacturer: null,
                release_date: null,
                price: null,
            },
        }
    },
    methods: {
        async createProduct() {
            await axios.post('/api/products', {product: this.product});
            this.$router.push('/products');
        }
    }
}

</script>
