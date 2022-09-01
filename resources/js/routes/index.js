import { createRouter, createWebHistory } from 'vue-router'
const routes = [
    {
      path: '/about',
      component: () => import('./About.vue')
    }
  ]
  const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
  })
  export default router