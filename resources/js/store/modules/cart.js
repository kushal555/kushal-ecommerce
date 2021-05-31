import * as types from '../mutation-types'

const state = {
  cart: JSON.parse(window.localStorage.getItem('cart')) || [],
  cart_count: 0
}

const getters = {
  cart: state => {
    console.log(typeof state.cart, JSON.parse(JSON.stringify(state.cart)))
    const cart = state.cart
    cart.forEach((product) => product.total = parseInt(product.price) * parseInt(product.count))
    state.cart_count = cart.reduce((a, c) => a + parseInt(c.count), 0)
    return cart
  },
  cartItemCount: state => state.cart_count
}

const mutations = {
  [types.ADD_TO_CART] (state, { product, count }) {
    product.count = parseInt(count)
    const productExists = state.cart.findIndex(p => p.id === product.id)
    if (productExists != -1) {
      state.cart[productExists] = product
    } else {
      state.cart.push(product)
    }
    state.cart_count = state.cart.reduce((a, c) => a + c.count, 0)
    window.localStorage.setItem('cart', JSON.stringify(state.cart))
  }
}

const actions = {
  addToCart ({ commit }, product) {
    commit(types.ADD_TO_CART, product)
  }
}

export default {
  state,
  getters,
  mutations,
  actions
}
