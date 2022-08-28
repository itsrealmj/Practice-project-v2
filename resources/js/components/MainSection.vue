
<template>
  <section class="top-deal">
    <h1>Main Section</h1>
    <div>
      <figure v-for="post in posts" :key="post.id" @click="(post)">
        <!-- <img :src="post.img" :alt="post.caption"> -->
		<span> {{post.id}}</span>
        <figcaption>{{post.name}}</figcaption>
        <p>$ {{post.price}}</p>
        <span> {{post.description}}</span><br>
		<router-link class="btn btn-success" :to="{ name: 'EditProduct', params: {id:post.id} }">edit</router-link>
		<form action="/api/delete/" method="post">
			<button type="submit" :value="post.id" name="id" class="btn btn-danger"> delete</button>
		</form>
      </figure>
    </div>
  </section>
</template>

<script setup>	
import { ref } from 'vue'

const posts = ref([])
const error = ref(null) 
const load = async () => {
	try {
		let datas = await fetch('http://localhost:8000/api/data')
		if (!datas.ok) {
			throw Error("Can't fetch data")
		}
		posts.value = await datas.json()
		
	}
	catch(err) {
		error.value = err.message
	}
}
	load()
	
	
	
</script>
<style>
	.top-deal {
		margin-top:1rem;
	}
	.top-deal h1 {
    
		background : #f1f1f1;
		margin:1rem 4rem;
		padding:1rem;
	}
	.top-deal div {
		margin:1rem 4rem;
		
		display:flex;
		gap: 1.7rem;
		justify-content:flex-start;
		flex-wrap:wrap;

	}

	.top-deal figure {
		font-size:15px;
		padding: 1rem 1.5rem;
		cursor:pointer;

		transition:.2s ease-in-out;
	}
	.top-deal figure figcaption {
		margin:5px 0;
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
	
</style>