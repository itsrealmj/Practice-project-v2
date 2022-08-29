
<template>
    <!-- <div>
		<DataTable :value="posts" responsiveLayout="scroll">
            <Column v-for="col of columns" :field="col.field" :header="col.header" :key="col.field"></Column>
        </DataTable>
		
    </div> -->
	<h1 class="text-center text-dark my-5 p-2 container ">Product Management Section</h1>
	<table class="table container">
		<thead >
			<tr >
			<th class="py-3" scope="col">ID</th>
			<th class="py-3" scope="col">IMAGE</th>
			<th class="py-3" scope="col">NAME</th>
			<th class="py-3" scope="col">DESCRIPTION</th>
			<th class="py-3" scope="col">PRICE</th>
			<th class="py-3" scope="col">ACTION</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="post in posts" :key="post.id">
				<th scope="row">{{ post.id }}</th>
				<td class="w-25">
					<img 
						:src="`../storage/images/${post.file_path.substring(14)}`"
					>
				</td>
				<td>{{post.name}}</td>
				<td>{{post.description}}</td>
				<td>{{post.price}}</td>

				<td class="" >
					<span class="">
						<router-link :to="{ name: 'EditProduct', params: {id:post.id} }">
							<Button 
								class="p-button-outlined px-0 py-0"
								icon="pi pi-times">
								Edit
							</Button>
						</router-link>
					</span>
					<span>
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
						<Button 
							@click="confirm2($event,post.id)" 
							icon="pi pi-trash" 
							class="p-button-danger p-button-outlined px-0 py-0">
						</Button>
					</span>
				</td>

			</tr>
		</tbody>
	</table>
</template>
<script setup>	

import { axiosAuth } from "../composables/axios";
import { ref, onMounted } from 'vue'
import ConfirmPopup from 'primevue/confirmpopup';
import Button from 'primevue/button';
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';     //optional for column grouping
import Row from 'primevue/row';                     //optional for row
import Image from 'primevue/image';


// name: "MainSection"
const columns = ref([
            {field: 'id', header: 'ID'},
            {field: 'file_path',header: 'IMAGE'},
			{field: 'name', header: 'NAME'},
            {field: 'description', header: 'DESCRIPTION'},
            {field: 'price', header: 'PRICE'},
			
            {field:"buttn", header: 'ACTION'}
        ]);



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
<style scoped>
	h1 {
		box-shadow: 1px 1px 5px 1px gray;
	}
	img {
		width: 100px;
		object-fit: cover;
	 }

</style>