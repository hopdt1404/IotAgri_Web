<template>
  <div class="main-layout">
    <navbar />

    <div class="mt-4 row">
      <div class="col-1 custom-grid">
        <navbar-vertical />
      </div>
      <div class="col-11 custom-grid">
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
