<template>
  <div>
    <b-button @click="addModal">{{ $t('add_product') }}</b-button>

    <b-modal static id="modal-1" no-close-on-backdrop hide-header-close v-model="showProductModal" size="xl" :title="$t('add_product')">
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
            <b-form-file  v-model="form.image"  @change="handleFile" :state="form.errors.has('image')" ></b-form-file>
            <has-error :form="form" field="image" />
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
            @click="saveProduct"
            :loading="form.busy"
            type="submit"
          >
            {{ $t('submit') }}
          </b-button>
        </div>
      </template>
    </b-modal>
  </div>
</template>
<script>
import Form from 'vform'
import axios from 'axios'
export default {
  name: 'Add',
  data () {
    return {
      form: new Form({
        product_name: '',
        category_id: '',
        subcategory_id: '',
        price: '',
        description: '',
        image: null,
        status: false
      }),
      categories_data: [],
      showProductModal: false
    }
  },
  computed: {
    categories () {
      return this.categories_data.filter(c => c.parent_id == null)
    },
    subcategories () {
      return this.categories_data.filter(c => c.parent_id == this.form.category_id)
    }
  },
  methods: {
    async addModal () {
      await this.getCategories()
      this.showProductModal = true
    },
    handleFile (event) {
      // We'll grab just the first file...
      // You can also do some client side validation here.
      const file = event.target.files[0]

      // Set the file object onto the form...
      this.form.image = file
    },
    async saveProduct () {
      await this.form.post('/api/product').then(response => {
        this.$bvToast.toast(`${this.$t('product_added_msg')}`, {
          title: `${this.$t('product_added')}`,
          toaster: 'b-toaster-top-full',
          appendToast: true,
          variant: 'success',
          solid: true
        })
        this.showProductModal = false
        this.$root.$emit('update-list')
      })
    },
    async getCategories () {
      axios.get('/api/category').then(response => {
        this.categories_data = response.data.data
      })
    }
  }
}
</script>
