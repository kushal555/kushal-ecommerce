<template>
    <div class="row">
      <div class="col-12">
        <div class="card product__detail flex-row">
          <div class="col-md-5 p-0">
            <img class="card-img" :src="product.image" alt="Vans">
          </div>
          <div class="col-md-7 p-0">
            <div class="card-body">
              <h4 class="card-title">
                {{ product.product_name }}
              </h4>
              <p class="card-text">
                {{ product.description }}
              </p>
              <div class="buy d-flex justify-content-between align-items-center">
                <div class="price text-success">
                  <h5 class="mt-4">
                    {{ price }}
                  </h5>
                </div>
              </div>
              <button class="btn btn-danger mt-3" @click.prevent="addToCart({ product: product, count: 1 })">{{ $t('add_to_cart') }} <b-icon icon="cart" class="icon-cart" fixed-width /></button>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'productDetail',
  computed : {
    ...mapGetters('product', ['product']),
    ...mapGetters('auth', ['user']),
    price () {
      return this.product.price && this.product.price.toLocaleString(this.user.language, { style: 'currency', currency: this.user.currency, minimumFractionDigits: 2, maximumFractionDigits: 2 }).replace('0.00', '')
    }
  },
  methods: {
    ...mapActions('product', ['fetchProduct']),
    ...mapActions('cart', ['addToCart'])
  },
  async created () {
    await this.fetchProduct({ product: this.$route.params.product })
  }
}
</script>

<style scoped>

</style>
