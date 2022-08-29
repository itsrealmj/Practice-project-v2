<template>
	<header>
      <nav  class="position-relative">
        <img src="./assets/images/logo.svg" alt="logo" />
        <ul>
          <router-link v-if="isLogIn" to="/">Home</router-link>
          <router-link v-if="isLogIn" to="/add">Add</router-link>
          <router-link v-if="isLogIn" to="/productManagement">Management</router-link>
		  <router-link v-if="isLogIn" to="/cart">Cart</router-link>
          <router-link v-if="isLogOut" to="/login">Login</router-link>
          <router-link v-if="isLogOut" to="/register">Signup</router-link>
          

          <div v-if="isLogIn" class="user-img mt-3  " >
			<img @click="setting" src="./assets/images/avatar-richard.png" alt="user-image">
		 	<div  v-if="logOutBtn" class="log-out-section position-absolute ">
				<img src="./assets/icon-close.svg" class="float-end closed-btn" @click="closedBtn" />
				<div class="px-3 pt-5 pb-3 settings">
					<div class="">
						{{email}}
					</div>
					<br>
					<button class="rounded btn btn-danger" @click="logout" >Logout</button>
				</div>
			</div> 
		  </div>
		  
		</ul>
      </nav>
    </header>

    <router-view />

</template>
<script setup>
import Menubar from 'primevue/menubar';

import { onMounted, ref } from "vue";

	let logOutBtn = ref(false)
	function setting() {
		logOutBtn.value = true

	}
	function closedBtn() {
		logOutBtn.value = !logOutBtn
	}

	function logout() {
		alert('You just logout')
		localStorage.clear()
		window.location.href = '/login'
	}
	
	let isLogIn = ref(true)
	let isLogOut = ref(true)
	const email = ref('')
	
	onMounted(() => {
		email.value = localStorage.getItem('user')
		if(email.value){
			isLogOut.value = !isLogOut

		}else {
			isLogIn.value = !isLogIn
		}
	});
</script>

<style>
	.router-link-exact-active {
		color:rgba(0, 0, 255, 0.805);
		font-style: italic;
		text-shadow: 1px 2px 3px gray;
	}
	header {
		background-color : white;
		box-shadow: 1px 1px 5px 1px gray;
		position:sticky;
		top:0;
		z-index:2;
	}
	header nav {
		display:flex;
		justify-content:space-between;
		align-items:center;
		padding:.5rem 5rem;

	}
	header nav ul {
		display:flex;
		gap:1rem;
		list-style:none;
	}
	header nav ul a {
        margin-top: 1rem;
        font-size: 1.1rem;
		text-decoration:none;
		position:relative;
		/* color:rgba(0,0,0, .7); */
		color:rgb(1, 1, 23);
		font-weight:600;

	}
	header nav ul a::after {
		content: "";
	    position: absolute;
	    bottom: -.5rem;
	    left: 0;
	    height: 3px;
	    width: 0;
	    background-color: orangered;
	    transition: .3s ease-in-out;
	}
	header nav ul a:hover::after {
		width: 100%;
	}

	header .user-img img{
		width: 35px;
		cursor: pointer;
	}

	header nav .log-out-section {
		background-color: rgb(233, 231, 231);
		border-radius: 5px;
		right: 1%;
		box-shadow:1px 1px 10px 1px gray;
	}
	header nav .closed-btn {
		padding: .5rem;
		border-radius: 5px;
		width: 30px;
		transition: .3s ease;
	}
	header nav .closed-btn:hover {
		background-color: #aba7a7;
	} 
	.settings {
		font-size: 1.2rem;
	}
	
</style>