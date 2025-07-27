import '../css/app.css';
import Vue from "./app/vue";
import { NewRouter } from './app/router';
import routes from '@/routes';

Vue.use(NewRouter(routes)).mount("#app")
