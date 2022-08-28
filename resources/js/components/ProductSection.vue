<template>

    <section class="top-deal container">
		<div class="product-section p-2">
			<h1 class="px-3">TOP DEALS</h1>

			<div class="p-2">
				<span class="p-float-label p-input-icon-right">
					<i class="pi pi-search" />
					<InputText class="p-1 " id="inputtext-right" type="text" v-model="search" name="category"/>
					<label for="inputtext-right">Search name</label>
				</span>
			</div>

		</div>
		<div class="row d-flex justify-content-around">
			<figure class="col-xs-6 col-sm-6 col-md-4 col-lg-3 each-product " v-for="post in posts" :key="post.id" >
				<img :src="`../storage/images/${post.file_path.substring(14)}`">

				<span>{{post.name}}</span>
				<span class="product-price text-light px-3 bg-dark">${{post.price}} </span>
				<!-- <h5> {{post.description}}</h5> -->

				<!-- <Rating :cancel="false" name="cancel" class="rating"/> -->
				
				<form @submit.prevent="addedToCart(post.id)">
					<button 
						type="submit" 
						:value="post.id" 
						name="id" 
						class="add-to-cart-btn mt-2"
					> Add to Cart
					</button>
				</form>
			</figure>
		</div>
 </section>	
 <div class="paginated-section ">
	<div class="showing">Showing {{ itemShowed }} Items of {{ totalItem }} -> </div>

	<button v-if="showPrevBtn " @click="prev(currentPage, lastPage)" :value="currentPage" class="" >Previous</button>
	<strong class="page">Page {{ currentPage }} of {{lastPage}} </strong> 
	<button v-if="showNextBtn"  @click="next(currentPage, lastPage)" :value="lastPage" class=" ">Next</button>
	<!-- <input type="number" class="change mx-2" v-model="change" />  -->
 </div>
<Toast></Toast>
</template>

<script setup>
import { axiosAuth } from "../composables/axios";
import { ref , computed, onMounted, watch} from 'vue'
import Message from 'primevue/message';
import InputText from 'primevue/inputtext';
import Rating from 'primevue/rating';
import Toast from 'primevue/toast';
import { useToast } from "primevue/usetoast";

	let change = ref(4)
	let totalItem = ref(null)
	let itemShowed = ref(null)

	watch(change,() => {
		displayAllProduct()
	})

	const search = ref('')
	const posts = ref([])

	const error = ref(null) 

	let currentPage = ref('')
	let lastPage = ref('')

	let showPrevBtn = ref(true)
	let showNextBtn = ref(true)

	const displayAllProduct = async (page = 1, search) => {
    const datas = await axiosAuth.get(`/api/data`, {
        params: {
            page: page,
            itemPerPage: change.value,
            search: search,
        },
    });
	
    const { total, current_page, last_page, to, prev_page_url, data } =
        datas.data;
		
        totalItem.value = total;
        currentPage.value = current_page;
        lastPage.value = last_page;
        itemShowed.value = to;

    	posts.value = data;
	};

	displayAllProduct()

	// Watching changes of the search input and fire the displayAllProduct() function again
	watch(search,() => {
		displayAllProduct(1,search.value)
	})

	// Function for NEXT BUTTON
	function next(currentPage, lastPage) {
		if(lastPage > currentPage){
			currentPage++
			if(currentPage == lastPage) { showNextBtn.value = !showNextBtn.value }
			displayAllProduct(currentPage)
		}
	}

	// Function for previous BUTTON
	function prev(currentPage, lastPage) {
		if(currentPage <= lastPage){
			currentPage--
			showNextBtn.value = true
			displayAllProduct(currentPage)
		}
	}

	
	// Added to Cart BUTTON
	const toast = useToast();

	// async function addedToCart(id) {
	// 	 const addedItem = await axios.post(`/api/addcart/`, {
    //   		id:id,
  	// 	})
	// 	if(addedItem.status === 200) {
    //     	toast.add({severity:'success', summary: 'Info Message', detail:'Added to cart', life: 3000});
	// 	}
	// }
	async function addedToCart(id) {
		try {
			await axiosAuth.post(`/api/addcart/${id}`);
			toast.add({
				severity: "success",
				summary: "Info Message",
				detail: "Added to cart",
				life: 3000,
			});
		} catch (error) {
			console.log(error);
		}
	}

</script>

<style>
	.top-deal {
		margin-top:1rem;
	}
	.top-deal .product-section {
		display: flex;
		align-items: center;
		justify-content: space-between;
		/* background : #f1f1f1; */
		background:rgb(1, 1, 23);
		/* color:rgba(0,0,0, .7) */
		color:#f1f1f1;
	}
	.top-deal div {
		display:flex;
		gap: 1.7rem;
		justify-content:flex-start;
		flex-wrap:wrap;
	}

	.top-deal figure {
		font-size:15px;
		padding: 1rem 1.5rem;
		cursor:pointer;
		text-align: center;
		transition:.2s ease-in-out;
	}
	.top-deal figure h4, strong {
		color: rgba(0,0,0, .7);
	}
	.top-deal figure span {
		font-weight:600;
	}
	.top-deal figure:hover {
		box-shadow: -5px 7px 10px -5px gray;
		transform:scale(1.01);
	}
	.top-deal div img {
		width:100px;
	}
	.top-deal .change {
		text-align: center;
		width: 40px;
	}
	.top-deal .each-product {
		width: 250px;
		position: relative;
	}
	.top-deal .product-price {
		position: absolute;
		top: 0;
		right: 0;
		margin: 1rem;
		font-size: 1.1rem;
		font-weight: bold;
		transform: rotate(10deg);

	}
	.top-deal .each-product img {
		width: 100%;
		height: 250px;
		object-fit: cover;
	}
	.top-deal .each-product .add-to-cart-btn {
		/* color: orangered; */
		color:#f1f1f1;
		background:rgb(1, 1, 23);
		/* background-color: transparent; */
		padding: .3rem .5rem;
		font-weight: bold;
		border-radius: 5px;
		border:none;
		box-shadow: 5px 5px 20px 1px rgb(221, 219, 219);
	}
	.paginated-section {
		margin: 3rem 0;
		display: flex;
		align-items: center;
		justify-content: center;

		gap:1rem;
	}
	.paginated-section .showing {
		background:rgb(1, 1, 23);
		color: whitesmoke;
		padding: .6rem 1rem;
	}
	.paginated-section button {
		background: white;
		border: 1px solid rgb(1, 1, 23);;
		font-weight: bold;
		padding: .5rem 1rem;
	}
	.page {
		border-bottom: 1px solid rgb(1, 1, 23);;
		color:rgb(1, 1, 23);;
		font-weight: bold;
		font-size: 14px;
		padding: .5rem 1rem;
	}
</style>

