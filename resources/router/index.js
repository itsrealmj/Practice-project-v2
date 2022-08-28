import { createRouter, createWebHistory } from "vue-router";
import Home from '../js/views/Home.vue'
import AddProduct from '../js/views/AddProduct.vue'
import EditProduct from '../js/views/EditProduct.vue'
import Cart from '../js/views/Cart.vue'
import ProductManagement from '../js/views/ProductManagement.vue'
import Register from '../js/views/Register.vue'
import Login from '../js/views/Login.vue'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/add',
        name: 'AddProduct',
        component: AddProduct
    },
    {
        path: '/productManagement',
        name: 'ProductManagement',
        component: ProductManagement
    },

    {
        path: '/editProduct/:id',
        name: 'EditProduct',
        component: EditProduct,
        props: true
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/cart',
        name: 'Cart',
        component: Cart,
        // props: true
    },
    
]

const router = createRouter({
    // history: createWebHistory(process.env.BASE_URL),
    history: createWebHistory(),
    routes
})

export default router   