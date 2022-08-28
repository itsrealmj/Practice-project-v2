<template>

  <div class="modal-bg" >
    <div class="modal-container">
        <img class="closed-modal-btn" src="/img/closed.png" alt="closedBtn" @click="closedModal(this)"/>
      <div class="modal">
        <div>
          <img :src="img" alt="" />
          <p>{{caption}}</p>
          <p>{{text}}</p>
        </div>
        <div>
          <form method="POST"> 
            Product ID : <input type="text" :value="id" disabled><br>   
            Price : <input type="text"  v-model="price" disabled><br>
            <span @click="inCart--, payment(inCart, price, total)"> - </span>
            <input  class="price-input"  v-model="inCart" disabled>
            <span  @click="inCart++, payment(inCart, price, total)">+</span>
            <br>
            <router-link to="/Cart"><button>AddtoCart</button></router-link>
            <input type="text" v-model="total">
          </form>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props : ['caption','text', 'price','img', 'id', 'inCart'],
  
  data() {
    return {
      total : 0,
    }
  },

  methods: {
    payment(inCart, price, total) {
      this.total = inCart * price
      return this.total
    }
  },
  computed: {

  }
}
</script>

<style>
  .modal-bg {
    background: rgba(0,0,0, .8);
    height: 100vh;
    width: 100%;
    position: fixed;
    top: 0;
    z-index: 2;
  }
  .modal-bg .modal-container  {
    position: relative;
    width: 500px;
    height: 300px;
    top: 20%;
    margin:0 auto;
  }
  .modal-bg .modal-container .modal {
    display: flex;
    justify-content: space-around;
    align-items: center;
    min-height: 300px;
    background: rgb(247, 241, 241);
    margin-top: 2rem;
    border-top: 10px solid rgb(245, 142, 7);;
    border-radius: 5px;
  }
  
  .modal-bg .modal img {
    width: 100px;
  }
  .modal-bg .modal-container .closed-modal-btn { width: 40px; position: absolute; top: .5rem; right: 0;}
  .modal p {
    font-size: 1.2rem;
  }
  .modal-bg form input {
    text-align: center;
    border: none;
    width: 35px;
  }
  .modal div {
    line-height: 3rem;
  }
  .modal form span {
    border: 1px solid gray;
    padding: .3rem .5rem;
    text-align: center;
    font-size: 1.3rem;
    cursor: pointer;
  }
  .modal form button {
    width: 100%;
    margin-top: 10px;
    padding: .5rem;
    background: rgb(245, 142, 7);
    border: none;
    border-radius: 5px;
    font-weight: 600;
    color:rgba(0,0,0, .7);
    box-shadow: 5px 5px 5px 0 gray;
    cursor: pointer;
  }
  .modal form button:hover{ color: rgba(0,0,0, .8); transform: scale(1.05); transition: .3s ease-in-out;}
</style>