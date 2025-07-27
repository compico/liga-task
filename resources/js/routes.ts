import { RouteRecordRaw } from 'vue-router';
import IndexPage from '@/pages/Index.vue';
import DefaultLayout from '@/layouts/DefaultLayout.vue';

const routes: RouteRecordRaw[] = [{
    path: "/",
    component: DefaultLayout,
    children: [
        {'path': '', component: IndexPage},
    ],
}];

export default routes;
