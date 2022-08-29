<template>
<h1 style="text-align:center" class="mt-3"> Edit Product</h1>

<form action="/api/update/" enctype="multipart/form-data" method="post" class="add-product-form mt-5">
  <div class="w-50 m-auto">
    <input type="hidden" :value="post.id" name="id">
    <div class="mb-3">
      <label class="form-label">Product Name</label>
      <input type="text" class="form-control" :value="post.name" name="name" >
    </div>
    
    <div class="mb-3">
      <label class="form-label">Upload photo</label>
      <input type="file" class="form-control" :v-model="post.file_path" name="image">
    </div>
    <div class="mb-3">
      <label class="form-label">Product Price</label>
      <input type="number" class="form-control" name="price" :value="post.price">
    </div>
    <div class="mb-3">
      <label class="form-label">Products Description</label>
      <input type="text" class="form-control" name="description" rows="3" :value="post.description"/>
    </div>
    <Button type="submit" icon="pi pi-check" class="mr-2 mb-2" label="Update"> </Button>
  </div>
</form>

</template>

<script>
import { ref } from 'vue'
import Button from 'primevue/button';
import { axiosAuth } from "../composables/axios";

export default {
    props: ['id'],
    // props.id from productsection params which give the ID of the triggered button EDIT
    setup(props) {
      
		const post = ref()
		const error = ref(null) 

		const load = async () => {
			try {
				const datas = await axiosAuth.get(`/api/manage/`)

				const dataItems = await datas.data
        // this will filter only one item which has the same value as the props.id 
        // and the single data from API endpoint
        dataItems.filter(item => {
          if(item.id == props.id) {
            // item will assign to post.value to store single item from DB
            post.value = item
            console.log(post.value)
          }
        })
			}
			catch(err) {
				error.value = err.message
			}
		}
		load()
		return { post , error, load}
	}
}
</script>