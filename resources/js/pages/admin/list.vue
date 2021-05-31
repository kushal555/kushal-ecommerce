<template>
  <div>
    <b-pagination
      pills
      v-model="currentPage"
      :total-rows="products.length"
      :per-page="perPage"
      aria-controls="my-table"
    ></b-pagination>
    <b-table striped hover :items="products" :per-page="perPage"
             :current-page="currentPage" :fields="fields" :busy="isBusy">
      <template #cell(thumbnail)="data">
        <b-img thumbnail fluid :src="data.value" alt="Image 1"></b-img>
      </template>
      <template #cell(status)="data">
        <b-icon icon="circle-fill" variant="success"></b-icon>
      </template>
      <template #cell(action)="data">
        <b-button variant="outline-success" @click="editProduct(data.item.id)">
          <b-icon icon="pencil"></b-icon> {{ $t('edit') }}
        </b-button>
        <b-button  @click="deleteProduct(data.item.id)" variant="outline-danger">
          <b-icon icon="trash"></b-icon>
          {{ $t('delete') }}
        </b-button>
      </template>
      <template #table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>
    </b-table>
    <edit @record-update="editProductModal = false" :product_id="product_id" v-if="editProductModal" />
  </div>
</template>
<script >

import Edit from './edit'
export default {
  name: 'ProductList',
  components: { Edit },
  metaInfo () {
    return { title: this.$t('products') }
  },
  middleware: 'auth',
  props: ['products', 'isBusy'],
  data () {
    return {
      perPage: 3,
      currentPage: 1,
      fields: [
        { key: 'product_name', label: this.$t('product_name'), sortable: true },
        { key: 'thumbnail', label: this.$t('thumb'), sortable: false },
        { key: 'price', label: this.$t('price'), sortable: true },
        { key: 'category', label: this.$t('category'), sortable: true },
        { key: 'subcategory', label: this.$t('sub_category'), sortable: true },
        { key: 'status', label: this.$t('status'), sortable: false },
        { key: 'action', label: this.$t('action'), sortable: false }
      ],
      editProductModal: false,
      product_id: null
    }
  },
  methods: {
    editProduct(product_id){
      this.product_id = product_id
      this.editProductModal = true
    }
  }
}
</script>
