<template>
<!-- <Message class="w-50 m-auto fixed-top" severity="success" v-if="showMessage">Successfully deleted</Message> -->
<div class="p-5 d-flex justify-content-around">
  <div class="m-2">
      <div class="card-img d-flex border-bottom pb-3 mb-3" v-for="cart in carts " :key="cart.id">
        <div class=" d-flex justify-content-between gap-3">
          <form action="/api/order/">
            <div class="card-details">
              <input type="checkbox" style="width:35px" class="mx-2" name="vehicle1" :value="cart.product.price">
                <img 
                  class=" product-img" 
                  :src="`../storage/images/${cart.product.file_path.substring(14)}`"
                >
                <div class="m-3">
                  <div >
                      <strong> {{ cart.product.name}} </strong> 

                      <div>
                          <span ><strong>Quantity : </strong> 

                            <span class="p-buttonset ">
                              <Button  
                                @click="changeQty(cart.id, operation = 'minus')" 
                                icon="pi pi-minus" 
                                class="p-0 m-0" />

                              <Button 
                                :disabled="true" 
                                class="p-0 px-3 m-0"> 
                                {{cart.qty}}
                              </Button>

                              <Button
                                @click="changeQty(cart.id, operation = 'add')" 
                                icon="pi pi-plus" 
                                class="p-0 m-0"/>
                            </span>
                          </span>
                      </div>

                      <h5 >$ {{ cart.product.price }}</h5>
                      {{ cart.product.description}}
                  </div>
                  <div>
                        <!-- <Button class="px-2 py-0 p-button-primary" label="fill">  
                        </Button> -->
                          
                  </div>
                </div>
            
          </div>
          </form>

          <div class="closed-btn">
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
                @click="confirm2($event,cart.id )" 
                icon="pi pi-times" 
                class="p-button-danger p-button-outlined px-0 py-0">
              </Button>
          </div>
        </div>
    </div>
  </div>


    <!-- left payment -->
    <div class="m-2">
        <!-- start here -->
        <div class="payment-container border rounded  p-2">
        <h4 class="border-bottom">Total</h4>

        <div class="">
            <div class="d-flex justify-content-between" >
                <strong>Sub-total</strong><strong>{{  }}</strong>
            </div>
            <div class="d-flex justify-content-between ">
                <strong>Delivery</strong><strong>$ 2</strong>
            </div>
        </div>

        <hr>
            
        <button class="font-weight-bold btn btn-success w-100 mb-4">Checkout</button>

        <strong >WE ACCEPT : </strong>
        <div class="payment-method d-flex justify-content-between">
            <img src="@/assets/paypal.png" alt="" width="100px">
            <img src="@/assets/mastercard.png" alt="" width="100px">
            <img src="@/assets/gcash.png" alt="" width="100px">
        </div>
    </div>
    </div>

    
</div>



</template>

<script setup>

import { axiosAuth } from "../composables/axios";
import Payment from './CartComponents/Payment.vue';
import Card from './CartComponents/Card.vue';

import {onMounted, ref} from 'vue';
import Message from 'primevue/message'; //Flash deleted product
// components: {Card, Payment }

import ConfirmPopup from 'primevue/confirmpopup';
import Button from 'primevue/button';
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';
import Checkbox from 'primevue/checkbox';


async function order () {
    const data = await axiosAuth.post(`api/order`)
    console.log(data)
  }

  async function changeQty (id, operation) {
    const data = await axiosAuth.post(`api/cart`, { id:id, operation: operation})
    displayedProducts()
  }
	const confirm = useConfirm();
	const toast = useToast();

	const confirm2 = (event,id) => {
		confirm.require({
			target: event.currentTarget,
			message: 'Do you want to delete this item?',
			icon: 'pi pi-info-circle',
			acceptClass: 'p-button-danger',
			accept: () => {
        deleteItem(id)
				toast.add({severity:'info', summary:'Confirmed', detail:'Item deleted', life: 3000});
			},
			reject: () => {
				toast.add({severity:'error', summary:'Rejected', detail:'You have rejected', life: 3000});
			}
		});
	}

	async function deleteItem(id) {
		const data = await axiosAuth.post(`/api/deletecart/`, {id: id})
    
		displayedProducts()
	}


    // ALL PPRODUCT IN CART DISPLAY
    const carts = ref([])
    
    const displayedProducts = async () => {
        const cartDetails = await axiosAuth.get(`/api/cart`)
        carts.value = cartDetails.data
        
    };
    displayedProducts()

    onMounted(() => {
        const userLog = localStorage.getItem('user')
        if(!userLog) {
            window.location.href = '/login'
        }
    });

    async function displayAllAddedCart() {
      const datas = await axiosAuth.get(`/api/alladdedcart`)
    }
    displayAllAddedCart()
</script>

<style>
  .card-img {
    width: 700px;
  }
   .card-img .card-details .product-img {
      width: 150px;
    }
    
</style>