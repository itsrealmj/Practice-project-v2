<template>
<!--  -->
<form action="/api/addProduct" enctype="multipart/form-data" method="POST" class="add-product-form mt-5 w-50">
      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" class="form-control" v-model="name" name="name" placeholder="Product name" required>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Upload photo</label>
        <input type="file" class="form-control" :v-model="image" name="image" required>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Product Price</label>
        <input type="number" class="form-control"  v-model="price" name="price" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Products Description</label>
        <textarea class="form-control" v-model="description" name="description" rows="3" required></textarea>
      </div>
      
      <Button type="submit" label="Add Product"></Button>
    </form>
</template>
<script setup>

import Button from 'primevue/button';
import {onMounted} from 'vue'

    // const name = ref()
    // const price = ref()
    // const desctiption = ref()
    // const image = ref()
    onMounted(() => {
        const userLog = localStorage.getItem('user')
        if(!userLog) {
            window.location.href = '/login'
        }
    });
    
</script>
<style>
.add-product-form {
    margin: 0 auto;
}
</style>
