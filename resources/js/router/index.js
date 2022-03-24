import { createRouter, createWebHistory } from 'vue-router';

// Import all of the resource routes files.
function loadRootRoutes() {
    let routeFolderContext = require.context("./", true, /\.route\.js$/); //(directory: current, sub folder : true, pattern: files end with .route.js)
    return routeFolderContext
        .keys()
        .map(routeFolderContext) // import module
        .map(routeFile => routeFile.default); // get `default` export from each resolved module
}

let rootRoutes = loadRootRoutes().flat();


const routes = [
    ...rootRoutes,
    {
        name: '404',
        path: '/404',
        component: () => import('../components/NotFound'),
    },
    {
        path: '/:pathMatch(.*)*',
        redirect: '404',
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
