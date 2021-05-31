<template>
  <div class="main-layout mt-5 pt-3">
    <navbar />

    <div class="container">
      <child />
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
