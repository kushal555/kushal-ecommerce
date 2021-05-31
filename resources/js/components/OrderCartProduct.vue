<template>
  <tr>
    <td class="col-sm-8 col-md-6">
      <div class="d-flex">
        <a class="thumbnail pull-left" href="#">
          <img  :src="product.thumbnail" alt="Vans" style="width: 72px; height: 72px;">
        </a>
        <div class="mx-3">
          <router-link tag="h4" :to="{ name: 'product.detail', params: { product: product.id } }" class="card-title pointer-event">
            {{ product.product_name }}
          </router-link>
        </div>
      </div>
    </td>
    <td class="col-sm-1 col-md-1" style="text-align: center">
      <input v-model="product.count"  type="number" class="form-control" @change="quantityChange(product)">
    </td>
    <td class="col-sm-1 col-md-1 text-center">
      <strong>{{ price }}</strong>
    </td>
    <td class="col-sm-1 col-md-1 text-center">
      <strong>{{ total }}</strong>
    </td>
    <td class="col-sm-1 col-md-1">
      <button type="button" class="btn btn-danger">
        <span class="glyphicon glyphicon-remove" /> Remove
      </button>
    </td>
  </tr>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'OrderCartProduct',
  props: ['cartProduct'],
  data () {
    return {
      product: {}
    }
  },
  computed: {
    ...mapGetters('auth', ['user']),
    price () {
      return this.product.price.toLocaleString(this.user.language, { style: 'currency', currency: this.user.currency, minimumFractionDigits: 2, maximumFractionDigits: 2 })
    },
    total () {
      return this.product.price * this.product.count
      return total.toLocaleString(this.user.language, { style: 'currency', currency: this.user.currency, minimumFractionDigits: 2, maximumFractionDigits: 2 })
    }
  },
  methods: {
    ...mapActions('cart', ['addToCart']),
    quantityChange () {
      const count = this.product.count || 0
      this.addToCart({ product: this.product, count: parseInt(count) })
    }
  },
  created () {
    this.product = this.cartProduct
  }
}
</script>

<style scoped>

</style>
