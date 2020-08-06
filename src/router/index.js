import Vue from 'vue'
import Router from 'vue-router'
import FormContact from '@/components/FormContact'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'FormContact',
      component: FormContact
    }
  ]
})
