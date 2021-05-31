<template>
  <card :title="$t('home')">
    {{ $t('you_are_logged_in') }}
  </card>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  beforeRouteEnter (to, from, next) {
    next(vm => {
      if (vm.user.role === 'shop') {
        vm.$router.push({ name: 'products.list' })
      } else {
        vm.$router.push({ name: 'user.products' })
      }
    })
  },
  middleware: 'auth',
  computed: mapGetters({
    user: 'auth/user'
  }),
  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
