import {createApp} from "vue";
import {createPinia} from "pinia";
import App from './src/App.vue';
import '../css/app.css';

const pinia = createPinia();

createApp(App)
    .use(pinia)
    .mount('#app')
