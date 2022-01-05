<template>
  <div class="main-layout">
    <navbar />

    <div class="mt-4 row">
      <div class="custom-grid width-13">
        <navbar-vertical />
      </div>
      <div class="col-10 custom-grid">
        <child />
      </div>

    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import NavbarVertical from '~/components/NavbarVertical'

export default {
  name: 'MainLayout',

  components: {
    Navbar,
    NavbarVertical
  }
}
</script>

<style scoped>
.width-13 {
  width: 13%;
}
</style>
