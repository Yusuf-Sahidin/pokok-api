<template>
  <div>
    <v-container grid-list-md>
      <v-subheader>{{category.name}}</v-subheader>
      <v-img v-if="category.image" :src="getImage('/categories/' + category.image)" height="150px"></v-img>
      <v-subheader>Product by "{{category.name}}" category"</v-subheader>
      <v-layout row wrap>
        <v-flex v-for="product in products" xs6 :key="product.id">
          <v-card :to="'/product/' + product.slug">
            <v-img v-if="product.image" :src="getImage('/products/' + product.image)" height="150px">
              <v-container fill-height fluid pa-2>
                <v-layout fill-height>
                  <v-flex xs12 align-end flexbox>
                    <span class="title white--text text-block">{{product.name}}</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-img>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn icon>
                <v-icon>favorite</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon>bookmark</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon>share</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
      <template>
        <div class="text-xs-center">
          <v-pagination v-model="page" @input="go" :length="lengthPage" :total-visible="5"></v-pagination>
        </div>
      </template>
    </v-container>
  </div>
</template>
<style scoped>
.text-block {
  position: absolute;
  bottom: 5px;
  left: 5px;
  background-color: black;
  padding-left: 5px;
  padding-right: 5px;
  opacity: 0.7;
  width: 100%;
}
</style>
<script>
export default {
  data() {
    return {
      category: [],
      products: [],
      page: 0,
      lengthPage: 0,
    };
  },
  methods: {
    go() {
      let slug = this.$route.params.slug;
      let url = "/categories/slug/" + slug;
      if (this.page > 0) url = url + "?page=" + this.page;
      url = encodeURI(url);
      this.axios
        .get(url)
        .then((res) => {
          let res_data = res.data;
          let category = res_data.data;
          this.category = category;
          this.products = category.products.data;
          this.lengthPage = category.products.last_page;
        })
        .catch((err) => {
          console.log(err.res);
        });
    },
  },
  created() {
    this.go();
  },
};
</script>
