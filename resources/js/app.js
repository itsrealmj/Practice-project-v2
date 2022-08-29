// app.js

import 'primevue/resources/primevue.min.css'              //core css
import 'primeicons/primeicons.css'                          //icons
import 'primevue/resources/themes/saga-blue/theme.css'     //theme
import './bootstrap';
import {createApp} from 'vue'
import router from '../router';
import App from './App.vue'
import PrimeVue from 'primevue/config';

import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Message from 'primevue/message';
import Rating from 'primevue/rating';
import ProgressSpinner from 'primevue/progressspinner';
import ConfirmPopup from 'primevue/confirmpopup';
import ConfirmationService from 'primevue/confirmationservice';
import ToastService from 'primevue/toastservice';
import Toast from 'primevue/toast';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';     //optional for column grouping
import Row from 'primevue/row';                     //optional for row
import Image from 'primevue/image';
import Menubar from 'primevue/menubar';


const app = createApp(App)

app.use(PrimeVue)
app.use(ToastService);
app.use(ConfirmationService);


app.use(router).mount('#app')


app.component('Button', Button);
app.component('InputText', InputText);
app.component('Message', Message);
app.component('Rating', Rating);
app.component('ProgressSpinner', ProgressSpinner);
app.component('ConfirmPopup', ConfirmPopup);
app.component('Toast', Toast);
app.component('DataTable', DataTable);
app.component('Column', Column);
app.component('ColumnGroup', ColumnGroup);
app.component('Row', Row);
app.component('Image', Image);
app.component('Menubar', Menubar);




