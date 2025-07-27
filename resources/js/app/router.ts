import { createMemoryHistory, createRouter, Router, RouteRecordRaw } from 'vue-router';

export const NewRouter = function (routes: RouteRecordRaw[]): Router {
    return createRouter({
        history: createMemoryHistory(),
        routes: routes,
    })
}
