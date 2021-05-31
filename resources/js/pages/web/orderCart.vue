<template>
  <div class="row">
    <div class="col-12">
      <table class="table table-hover product__ordercart">
        <thead>
          <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th class="text-center">
              Price
            </th>
            <th class="text-center">
              Total
            </th>
            <th />
          </tr>
        </thead>
        <tbody>
          <OrderCartProduct v-for="product in cart" :key="product.id" :cart-product="product" />
          <tr>
            <td />
            <td />
            <td />
            <td><h3>Total</h3></td>
            <td class="text-right">
              <h3><strong>{{ grandTotal }}</strong></h3>
            </td>
          </tr>
          <tr>
            <td colspan="5">
              <div class="d-flex justify-content-between">
                <router-link :to="{ name: 'user.products' }" type="button" class="btn btn-primary">
                  <span class="glyphicon glyphicon-shopping-cart" /> Continue Shopping
                </router-link>
                <button type="button" class="btn btn-success">
                  Checkout <span class="glyphicon glyphicon-play" />
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import OrderCartProduct from '../../components/OrderCartProduct'
export default {
  name: 'OrderCart',
  components: { OrderCartProduct },
  computed: {
    ...mapGetters('auth', ['user']),
    ...mapGetters('cart', ['cart']),
    grandTotal () {
      const total = this.cart.reduce((a, c) => a + parseInt(c.total), 0)
      return total.toLocaleString(this.user.language, { style: 'currency', currency: this.user.currency, minimumFractionDigits: 2, maximumFractionDigits: 2 })
    }
  },

}
</script>

<style scoped>

</style>
