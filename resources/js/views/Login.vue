<template>
<ProgressSpinner v-if="loadingSpinner" class="loading-spinner"  />
     <div>
        <img class="blob" src="@/assets/blob.svg" alt="">
    </div>
    <div class="login-container col-xs-12">
        <h4>LOGIN</h4>

        <form @submit.prevent="loginNow">
        <!-- <form action="/api/login" method="post"> -->
            <label class="mb-2" >Email address</label>
            <input type="email" name="email" v-model="email" class="form-control" placeholder="Enter email" required>
            <label class="mb-2">Password</label>
            <input type="password" title="mus be at least 5 chars long"  name="password" v-model="password" class="form-control" placeholder="Password" >
        
            <button class="w-100">LOGIN </button>

            <div class="mt-3">
                <span>Need an account ? <router-link to="/register">SIGN UP </router-link></span>
            </div>
        </form>
    </div>
     
</template>
 <script setup> 
import axios from 'axios'
import {ref, onMounted} from 'vue'
import ProgressSpinner from 'primevue/progressspinner';


let email = ref('')
let password = ref(null)

    let loadingSpinner = ref(false)
    const loginNow = async () => {
        try {
            const response = await axios.post(`/api/login`, {
                email: email.value,
                password: password.value
            })

            loadingSpinner.value = true
            window.location.href = '/';
            localStorage.setItem('user', JSON.stringify(email.value))
            localStorage.setItem('user_token', response.data.user_token)
        } catch (err) {
            console.log(err.response.data);
        }
    }

    onMounted(() => {

        let userLog = localStorage.getItem('user')

        if(userLog) { window.location.href = '/' }

        if(userLog) { alert('You are already sign in')}
    });
    
 </script>
<style >
    .loading-spinner {
        position: absolute;
        top: 40%;
        left: 45%;
    }
    .sign-up-form {
        box-shadow:1px 1px 10px 1px rgba(215, 215, 245, 0.6);
    }
    .login-container {
        background: white;
        width: 40%;
        margin:5rem auto;
        padding: 1rem 2rem;
        border-radius: 5px;
        z-index: 2;
        box-shadow:5px 5px 10px 1px rgb(198, 198, 198);
    }
    .login-container h4 {
        margin-bottom: 2rem;
    }
    .login-container input {
        
        border-radius: 0;
        margin:0 0 1rem 0;
        padding: .5rem .3rem;
        background: none;
        border: none;
        border-bottom: 1px solid gray;
        outline: none;
        
    }
    .login-container button {
        border-radius: 5px;
        margin-top: 1rem;
        padding: .3rem 0;
        border: none;
        transition: .3s ease-in-out;
        background-color: orangered;
        color:white;
    }
    .login-container button:hover {
        transform: scale(1.01);
        color: whitesmoke;
    }
    .blob {
        position: absolute;
        top: -15%;
        left: 15%;
        max-width: 900px;
        z-index: -1;
    }
</style>