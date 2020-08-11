<template>
  <v-app-bar dark color="primary">
    <v-app-bar-nav-icon @click="setSideBar(!sideBar)"></v-app-bar-nav-icon>
    <v-btn icon @click="$router.go(-1)">
      <v-icon>arrow_back</v-icon>
    </v-btn>

    <v-toolbar-title class="white--text">Toko Bahan Pokok</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn icon @click="cart()">
      <v-badge left overlap color="orange">
        <span slot="badge" v-if="countCart>0">{{countCart}}</span>
        <span slot="badge" v-else>0</span>
        <v-icon>shopping_cart</v-icon>
      </v-badge>
    </v-btn>

  </v-app-bar>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';
export default {
  name: 'c-header',
  methods: {
    ...mapActions({
      setSideBar: 'setSideBar',
      setStatusDialog: "dialog/setStatus",
      setComponent: "dialog/setComponent",
    }),
    cart() {
      this.setStatusDialog(true);
      this.setComponent("cart");
      this.setSideBar(false);
    },
  },
  computed: {
    ...mapGetters({
      sideBar: 'sideBar',
      countCart: "cart/count",
    }),
    isHome() {
      return (this.$route.path === '/');
    },
  },
};
</script>
