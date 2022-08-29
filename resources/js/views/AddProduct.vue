<template>
<form action="/api/addProduct" enctype="multipart/form-data" method="POST" class="add-product-form mt-5 w-50">
      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" class="form-control" v-model="name" name="name" placeholder="Product name" required>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Upload photo</label>
        <input @change="handleChange" type="file" class="form-control" :v-model="image" name="image" required>
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

import axios from 'axios';
import Button from 'primevue/button';
import {onMounted, ref} from 'vue'
import FormData from 'form-data'

    const name = ref()
    const price = ref()
    const description = ref()
    let image = ref()

    // function handleChange(e) {
    //     image.value = e.target.files[0].name

    // }

    // async function addProductDisplay () {

    //   let formData = new FormData();

    //   formData.set('image', image.value)
    //   formData.set('name', name.value)
    //   formData.set('price', price.value)
    //   formData.set('description', description.value)


    //   const data = await axios.post(`/api/addProduct`, formData)
    //   console.log(data)
    // }

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
