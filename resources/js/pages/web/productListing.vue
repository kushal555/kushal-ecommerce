<template>
    <div class="row">
      <Product v-for="product in products" :key="product.id" :product="product"  />
     </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Product from '../../components/Product'
export default {
  name: 'productListing',
  components: { Product },
  computed: {
    ...mapGetters('product', ['products'])
  },
  methods: {
    ...mapActions('product', ['fetchProducts'])
  },
  async created () {
    await this.fetchProducts()
  }
}
</script>

<style scoped>

</style>
