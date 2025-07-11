import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import AddView from '@/views/AddView.vue'
import SoldView from '@/views/SoldView.vue'
import OperaView from '@/views/OperaView.vue'
import ContactView from '@/views/ContactView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/add',
      name: 'add',
      component: AddView
    },
    {
      path: '/sold',
      name: 'sold',
      component: SoldView
    },
    {
      path: '/contact',
      name: 'contact',
      component: ContactView
    },
    {
      path: '/opera/:id',
      name: 'opera',
      component: OperaView
    },

  ],
})

export default router
