import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import About from '../views/About.vue'
import store from '../store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/about',
    name: 'about',
    component: About,
  },
  {
    path: '*',
    redirect: {
      name: 'home',
    },
  },
  {
    path: '/categories',
    name: 'categories',
    component: () => import('../views/Categories.vue'),
  },
  {
    path: "/category/:slug",
    name: "category",
    component: () => import("../views/Category.vue"),
  },
  {
    path: "/checkout",
    name: "checkout",
    component: () => import("../views/Checkout.vue"),
    meta: { auth: true },
  },
  {
    path: "/payment",
    name: "payment",
    component: () => import("../views/Payment.vue"),
    meta: { auth: true },
  },
  {
    path: "/profile",
    name: "profile",
    component: () => import("../views/Profile.vue"),
    meta: { auth: true },
  },
  {
    path: "/edit-profile/:id",
    name: "profile",
    component: () => import("../views/Edit-Profile.vue"),
    meta: { auth: true },
  },
  {
    path: "/my-order",
    name: "my-order",
    component: () => import("../views/MyOrder.vue"),
    meta: { auth: true },
  },
  {
    path: '/products',
    name: 'products',
    component: () => import('../views/Products.vue'),
  },
  {
    path: '/product/:slug',
    name: 'product',
    component: () => import('../views/Product.vue'),
  },
];

const router = new VueRouter({
  mode: 'history',
  baase: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.auth)) {
    if (store.getters["auth/guest"]) {
      store.dispatch("alert/set", {
        status: true,
        text: "Login First",
        color: "error",
      });
      store.dispatch("setPrevUrl", to.path);
      store.dispatch("dialog/setComponent", "login");
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router
