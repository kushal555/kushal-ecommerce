<template>
  <b-modal id="modal-1" v-model="showProductModal" static no-close-on-backdrop hide-header-close size="xl" :title="$t('edit_product')">
    <form action="" @submit.prevent  @keydown="form.onKeydown($event)">

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('product_name') }}</label>
        <div class="col-md-7">
          <input v-model="form.product_name" :class="{ 'is-invalid': form.errors.has('product_name') }" class="form-control" type="text" name="product_name">
          <has-error :form="form" field="product_name" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('category') }}</label>
        <div class="col-md-7">
          <b-form-select v-model="form.category_id" :class="{ 'is-invalid': form.errors.has('category_id') }" :options="categories"></b-form-select>
          <has-error :form="form" field="category_id" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('sub_category') }}</label>
        <div class="col-md-7">
          <b-form-select v-model="form.subcategory_id"  :class="{ 'is-invalid': form.errors.has('subcategory_id') }" :options="subcategories"></b-form-select>
          <has-error :form="form" field="subcategory_id" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('price') }}</label>
        <div class="col-md-7">
          <input v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }" class="form-control" type="text" name="price">
          <has-error :form="form" field="price" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('description') }}</label>
        <div class="col-md-7">
          <textarea v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" class="form-control" type="text" name="description"></textarea>
          <has-error :form="form" field="description" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('image') }}</label>
        <div class="col-md-7">
          <template v-if="typeof form.image == 'string'">
            <b-img rounded  thumbnail fluid :src="form.thumbnail" alt="Image 1"></b-img>
            <b-button  @click="deleteImage(form.id)" variant="outline-danger">
              <b-icon icon="trash"></b-icon>
              {{ $t('delete') }}
            </b-button>
          </template>
          <template v-else>
            <b-form-file   @change="handleFile" v-model="form.image" :state="!form.errors.has('image')" ></b-form-file>
            <has-error :form="form" field="image" />
          </template>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('status') }}</label>
        <div class="col-md-7">
          <b-form-checkbox v-model="form.status" size="lg" switch></b-form-checkbox>
          <has-error :form="form" field="status" />
        </div>
      </div>
    </form>
    <template #modal-footer>
      <div class="w-100">
        <b-button
          variant="primary"
          @click="showProductModal=false"
        >
          {{ $t('cancel') }}
        </b-button>
        <b-button
          variant="success"
          @click="updateProduct"
          :loading="form.busy"
          type="submit"
        >
          {{ $t('submit') }}
        </b-button>
      </div>
    </template>
  </b-modal>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Form from 'vform'
import axios from 'axios'
export default {
  name: 'edit',
  props: ['product_id'],
  data () {
    return {
      form: new Form({
        product_name: '',
        category_id: '',
        subcategory_id: '',
        price: '',
        description: '',
        image: null,
        status: false,
        _method: 'PUT'
      }),
      categories_data: [],
      showProductModal: false
    }
  },
  computed: {
    ...mapGetters('product', ['product']),
    categories () {
      return this.categories_data.filter(c => c.parent_id == null)
    },
    subcategories () {
      return this.categories_data.filter(c => c.parent_id == this.form.category_id)
    }
  },
  methods: {
    ...mapActions('product', ['fetchProduct']),
    async getCategories () {
      axios.get('/api/category').then(response => {
        this.categories_data = response.data.data
      })
    },
    deleteImage () {
      this.form.image = null
    },
    handleFile (event) {
      // We'll grab just the first file...
      // You can also do some client side validation here.
      const file = event.target.files[0]

      // Set the file object onto the form...
      this.form.image = file
    },
    async updateProduct () {

      await this.form.post('/api/product/' + this.form.id).then(response => {
        this.$bvToast.toast(`${this.$t('product_updated_msg')}`, {
          title: `${this.$t('product_updated')}`,
          toaster: 'b-toaster-top-full',
          appendToast: true,
          variant: 'success',
          solid: true
        })
        this.showProductModal = false
        this.$root.$emit('update-list')
        this.$emit('record-update')
      })
    },
  },
  async created () {
    await this.getCategories()
    await this.fetchProduct({ product: this.product_id })
    this.form = new Form({
      id: this.product.id,
      product_name: this.product.product_name,
      category_id: this.product.category_id,
      subcategory_id: this.product.subcategory_id,
      price: this.product.price,
      description: this.product.description,
      image: this.product.image,
      thumbnail: this.product.thumbnail,
      status: this.product.status,
      _method: 'PUT'
    })
    this.showProductModal = true
  }
}
</script>

<style scoped>

</style>
