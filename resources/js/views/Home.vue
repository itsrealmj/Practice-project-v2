<template>
    <Banner />
    <!-- <Feature /> -->
    <!-- <MainSection /> -->
    <ProductSection />
    <Footer />
</template>

<script setup>
import Banner from '../components/Banner.vue'
// import MainSection from '../components/MainSection.vue'
import Footer from '../components/Footer.vue'
import Feature from '../components/Feature.vue'
import ProductSection from '../components/ProductSection.vue'

import {onMounted} from 'vue'
import axios from 'axios'

components: {Banner, Footer, Feature, ProductSection}
    // onMounted(() => {
    //     const userLog = localStorage.getItem('user')
    //     if(!userLog) {
    //         window.location.href = '/login'
    //     }
    // })
        
        
    

</script>
