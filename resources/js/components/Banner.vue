<template>
	<section class="banner-section container">
      <aside>
        <ul>
		  <li><a href="#">Top Deals</a></li>
          <li ><a href="#"> Phone Section</a></li>
          <li><a href="#">Laptop Section</a></li>
          <li><a href="#">Speaker Section</a></li>
          <li><a href="#">Socks Section</a></li>
          <li><a href="#">Shoes Section</a></li>
          <li><a href="#">Dress Section</a></li>
        </ul>
      </aside>
      <div class="promo-section">
        <img src="../assets/banner1.jpg">
      </div>
    </section>
</template>
<script>
export default {
	data() {
      return {
		show : false,
        products: [
          {price: 99, id: 1, img: '/img/speaker.png', caption: 'Product One', inCart:1,  text: 'The Best Speaker'},
          {price: 100, id: 2, img: './img/phone.png', caption : 'Product Two', inCart:1,  text: 'The Best Phoone'},
          {price: 101, id: 3, img: './img/laptop.png', caption : 'Product Three', inCart:1,  text: 'The Best Laptop'},
		  {price: 99, id: 1, img: '/img/speaker.png', caption: 'Product One', inCart:1,  text: 'The Best Speaker'},
          {price: 100, id: 2, img: './img/phone.png', caption : 'Product Two', inCart:1,  text: 'The Best Phoone'},
          {price: 101, id: 3, img: './img/laptop.png', caption : 'Product Three', inCart:1,  text: 'The Best Laptop'}
        ]
      }
    },
	methods: {
	},
	computed: {
	}

}
</script>

<style>
	.banner-section {
		margin:1rem auto 0;
		display:flex;
		gap:1rem;
		height:350px;
    }
	.banner-section aside {
		background : #f1f1f1;
		background : #A62349;
		/* background:rgb(1, 1, 23); */
		border-radius:5px;
		width:200px;
	}
	aside ul {
		list-style:none;
		line-height:2.5rem;
	}
	aside ul li a {
		/* color: white; */
		color: rgba(0, 0, 0, 0.635);
		font-weight:600;
		text-decoration : none;
		position: relative;
	}
	aside ul li a::after {
		content: "";
    position: absolute;
    bottom: -.5rem;
    left: 0;
    height: 3px;
    width: 0;
    /* background-color: red; */
    transition: .3s ease-in-out;
	}
	aside ul li a:hover::after {
		width: 100%;
    	background-color: rgba(255, 68, 0, 0.775);

	}
	.banner-section .promo-section {
		width:100%;
	}
	.banner-section .promo-section img {
		width:100%;
		height:100%;
		border-radius:5px;
	}
</style>