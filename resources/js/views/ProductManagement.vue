
<template>
  <section class="product-mgt container-fluid">
    <h1>Product Management Section</h1>
	<table class="container ">
		<thead class=" ">
		<tr >
			<th><h5>ID</h5></th>
			<th><h5>Image</h5></th>
			<th><h5>Name</h5></th>
			<th><h5>Description</h5></th>
			<th><h5>Price</h5></th>
			<th><h5>Action</h5></th>
		</tr>
		</thead>
		<tbody>
		<tr v-for="post in posts" :key="post.id">
			<td>{{post.id}}</td>
			<img class="w-25" :src="`../storage/images/${post.file_path.substring(14)}`">

			<td>{{post.name}}</td>

			<td class="desc w-50">{{post.description}}</td>
			<td>{{post.price}}</td>
			
			<td class="d-flex gap-2">
				<router-link :to="{ name: 'EditProduct', params: {id:post.id} }">
					<Button class="p-button-outlined" >Edit</Button>
				</router-link>
				
				<div>
					<ConfirmPopup></ConfirmPopup>
					<ConfirmPopup group="demo">
						<template #message="slotProps">
							<div class="flex p-4">
								<i :class="slotProps.message.icon" style="font-size: 1.5rem"></i>
								<p class="pl-2">{{slotProps.message.message}}</p>
							</div>
						</template>
					</ConfirmPopup>
					<Toast />
					<Button @click="confirm2($event,post.id)" icon="pi pi-times" label="Delete" class="p-button-danger p-button-outlined"></Button>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
  </section>

</template>
<script setup>	

import { axiosAuth } from "../composables/axios";
import { ref, onMounted } from 'vue'
import ConfirmPopup from 'primevue/confirmpopup';
import Button from 'primevue/button';
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';



// name: "MainSection"

	const confirm = useConfirm();
	const toast = useToast();

	const confirm2 = (event,id) => {
		confirm.require({
			target: event.currentTarget,
			message: 'Do you want to delete this record?',
			icon: 'pi pi-info-circle',
			acceptClass: 'p-button-danger',
			accept: () => {
				deleteProduct(id)
				toast.add({severity:'info', summary:'Confirmed', detail:'Record deleted', life: 3000});
			},
			reject: () => {
				toast.add({severity:'error', summary:'Rejected', detail:'You have rejected', life: 3000});
			}
		});
	}

	async function deleteProduct(id) {
		const data = await axiosAuth.post(`/api/delete/`, {id: id})
		console.log(data.status)
		loadAllProduct()
	} 

	const posts = ref([])
	const error = ref(null) 

	const loadAllProduct = async () => {
		try {
			let datas = await axiosAuth.get('/api/manage')
			posts.value = datas.data

		}
		catch(err) {
			error.value = err.message
		}
	}

	loadAllProduct()

    onMounted(() => {
        const userLog = localStorage.getItem('user')
        if(!userLog) {
            window.location.href = '/login'
        }
    });	


</script>
<style>
	.product-mgt {
		margin-top:1rem;
	}
	.product-mgt h1 {
		color: rgba(0, 0, 0, .7);
		background : #f1f1f1;
		margin:1rem 4rem;
		padding:1rem;
	}
	.product-mgt table {
		margin:1rem 4rem;
		padding:1rem;
	}
	table td {
		margin-bottom: 1rem;
	}

</style>