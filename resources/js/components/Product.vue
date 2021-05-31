<template>
  <div class="col-12">
    <div class="card product__listing flex-row">
      <div class="col-md-4 p-0">
        <img class="card-img" :src="product.thumbnail" alt="Vans">
      </div>
      <div class="col-md-8 p-0">
        <div class="card-body">
          <router-link tag="h4" :to="{ name: 'product.detail', params: { product: product.id } }" class="card-title pointer-event">
            {{ product.product_name }}
          </router-link>
          <p class="card-text">
            {{ product.description }}
          </p>
          <div class="buy d-flex justify-content-between align-items-center">
            <div class="price text-success">
              <h5 class="mt-4">
                {{ price }}
              </h5>
            </div>
            <button class="btn btn-danger mt-3" @click.prevent="addQuantity({ product: product, count: 1 })">{{ $t('add_to_cart') }} <b-icon icon="cart" class="icon-cart" fixed-width /></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'Product',
  props: ['product'],
  computed: {
    ...mapGetters('auth', ['user']),
    ...mapGetters('cart', ['cart']),
    price () {
      return this.product.price.toLocaleString(this.user.language, { style: 'currency', currency: this.user.currency, minimumFractionDigits: 2, maximumFractionDigits: 2 }).replace('0.00', '')
    }
  },
  methods: {
    ...mapActions('cart', ['addToCart']),
    addQuantity () {
      const product = this.cart.find(p => p.id === this.product.id)
      const count = product && product.count ? parseInt(product.count) + 1 : 1
      console.log(count)
      this.addToCart({ product: this.product, count: count })
    }
  }
}
</script>
