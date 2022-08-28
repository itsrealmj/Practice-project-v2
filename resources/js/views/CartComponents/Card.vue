<template>
  <div class="card-img d-flex border-bottom pb-3 mb-3" v-for="cart in carts " :key="cart.cart_id">
      <div class=" d-flex justify-content-between gap-3"> 
        <div class="card-details">
          <img class="w-25" :src="`../storage/images/${cart.cart_product_path.substring(14)}`">
          <div class="m-3">
            <div>
                <h5 class="mt-3">{{ cart.cart_product_name }}</h5>
                <br>

                <div class="">
                    <h6>{{ cart.cart_product_desc}}</h6>
                    <span>Quantity : 
                      <span @click="cart.cart_product_qty--">-</span> 
                        {{ cart.cart_product_qty }} 
                      <span @click="cart.cart_product_qty++">+</span>
                    </span>
                </div>

                <h5>$ {{ cart.cart_product_price * cart.cart_product_qty }}</h5>
            </div>
            <div>
                <button class="btn btn-primary d-flex align-items-center mt-3"> 
                    <span class="material-symbols-outlined">favorite</span>
                    <span class="">Save for later</span>
                </button>
            </div>
          </div>
        </div>
        <div class="closed-btn">
          <form action="/api/deletecart" method="post">
            <button type="submit" name="id" class="material-symbols-outlined border-0 bg-danger text-white" :value="cart.id">close</button>
          </form>
        </div>
      </div>

      
  </div>

</template>

<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const carts = ref([])

const load = async () => {
    const cartDetails = await window.axios.get(`http://localhost:8000/api/cart`)
    carts.value = cartDetails.data
    console.log(carts.value)
};
load()


</script>
 <style>
 .card-img {
  position: relative;
}

 .card-img .closed-btn {
  position: absolute;
  right: 0;
 }
 .card-img .card-details {
  display: flex;
  /* width: 700px; */
  flex-direction: row;
 }
 .card-img img {
  width: 150px;
  object-fit: cover;
 }
 </style>