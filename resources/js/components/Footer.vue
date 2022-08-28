<template>
  <footer class="footer">
      <form class="grid1">
        <input type="text" placeholder="Update you inbox ...">
        <button type="submit">Send</button>
      </form>
      <ul class="middle-footer grid2">
        <li> <a href="#">Pricing</a> </li>
        <li> <a href="#">Product</a> </li>
        <li> <a href="#">About Us</a> </li>
        <li> <a href="#">Community</a> </li>
        <li> <a href="#">Company Policy</a> </li>
      </ul>
      <div class="media-links grid3">
          <img src="../assets/images/icon-facebook.svg" alt="">
          <img src="../assets/images/icon-instagram.svg" alt="">
          <img src="../assets/images/icon-pinterest.svg" alt="">
          <img src="../assets/images/icon-twitter.svg" alt="">
          <img src="../assets/images/icon-youtube.svg" alt="">
      </div>
      <img class="grid4" src="../assets/images/logo.svg" alt="">
      <p class="grid5">Copyright {{ currentDate }} <span class="current-year"></span>. All rights reserve.</p>
    </footer>
</template>

<script>
  export default {
    data() {
      return {
        currentDate: new Date().getFullYear(),
      }
    },
    methods: {
      
    }
}
</script>
<style>
  .footer {
    background:rgb(1, 1, 23);
  }
  .footer .middle-footer {
    display:grid;
    gap:10px;
    grid-template-columns:1fr 1fr;
  }
  .footer .middle-footer a {
    color: #f1f1f1;
    text-decoration:none;
    padding-bottom : 5px;
    line-height : 1.5rem;
    font-size: 1.07rem ;
    border-bottom : 1px solid #f1f1f1;
  }
  .footer .middle-footer a:hover {
    color: gray;
    transition: .2s ease-in-out;
    border-bottom : 1px solid gray;
  }
  .grid1 { grid-area: grid1;}
  .grid2 { grid-area: grid2;}
  .grid3 { grid-area: grid3;}
  .grid4 { grid-area: grid4;}
  .grid5 { grid-area: grid5;}
  footer {
      background : #f1f1f1;
      display: grid;
      grid-template-areas:
      "grid4 grid4 grid2 grid2 grid1 grid1"
      "grid3 grid3 grid2 grid2 grid5 grid5"
      ;
      justify-content: space-between;
      padding: 3rem 0rem 3rem 6rem ;
  }
  .footer .media-links img {
      width: 25px;
      margin-right:10px;
  }
  .footer form input {
      padding: .4rem .6rem ;
      border:none;
      font-size : 1rem;
      border-radius:5px;
      border:1px solid rgba(255, 68, 0, 0.775);
      outline:none;
      
  }
  .footer form button {
      padding: .4rem .6rem ;
      margin-left:5px;
      color:#f1f1f1;
      font-weight:600;
      border:none;
      font-size : 1rem;
      border:1px solid rgba(255, 68, 0, 0.775);
      border-radius:5px;
      background-color: rgba(255, 68, 0, 0.775);
      
  }
  .footer p {
    color:#f1f1f1;
  }
</style>