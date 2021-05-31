<template>
  <b-card :title="$t('products')">
    <template #header>
      <h6 class="mb-0">{{ $t('products') }}</h6>
      <div class="text-right"><Add /></div>
    </template>
    <List :products="products" :is-busy="isBusy" />
  </b-card>
</template>
<script>
import List from './list'
import Add from './add'
import { mapGetters } from 'vuex'
export default {
  components: { Add, List },
  middleware: ['auth', 'role:shop'],
  computed: mapGetters({
    products: 'product/products',
    isBusy: 'product/isBusy'
  }),
  methods: {
    async fetchProducts () {
      await this.$store.dispatch('product/fetchProducts')
    }
  },
  async created () {
    // Fetch the user.
    await this.fetchProducts()

    this.$root.$on('update-list', () => {
      this.fetchProducts()
    })
  }
}
</script>
