import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  products: [],
  product: {},
  isBusy: false
}

// getters
export const getters = {
  products: state => state.products,
  product: state => state.product,
  isBusy: state => state.isBusy
}

// mutations
export const mutations = {
  [types.FETCH_ALL_PRODUCTS] (state, { products }) {
    state.products = products
  },

  [types.FETCH_PRODUCT] (state, { product }) {
    state.product = product
  },
  [types.SET_BUSY] (state, { status }) {
    state.isBusy = status
  }
}

// actions
export const actions = {

  async fetchProducts ({ commit }) {
    commit(types.SET_BUSY, { status: true })
    try {
      const { data } = await axios.get('/api/product')

      commit(types.FETCH_ALL_PRODUCTS, { products: data.data })
      commit(types.SET_BUSY, { status: false })
    } catch (e) {
      commit(types.FETCH_ALL_PRODUCTS, { products: [] })
      commit(types.SET_BUSY, { status: false })
    }
  },
  async fetchProduct (ctx, { product }) {
    try {
      const { data } = await axios.get(`/api/product/${product}`)
      ctx.commit(types.FETCH_PRODUCT, { product: data.data })
      return data
    } catch (e) {
      ctx.commit(types.FETCH_PRODUCT, { product: {} })
    }
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
