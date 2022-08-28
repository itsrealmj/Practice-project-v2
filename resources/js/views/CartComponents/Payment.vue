<template>
    <div class="payment-container border rounded  p-2">
        <h4 class="border-bottom">Total</h4>

        <div class="">
            <div class="d-flex justify-content-between" >
                <strong>Sub-total</strong><strong>{{}}</strong>
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
</template>

<style>
.payment-container {
}
.payment-method img {
    object-fit: contain;
    transition:.3s ease-in-out;
    cursor: pointer;
}
.payment-method img:hover {
    transform:scale(1.05);
}
</style>