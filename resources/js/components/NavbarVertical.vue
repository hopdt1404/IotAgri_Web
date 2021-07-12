<template>
  <div v-if="user">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <ul class="nav flex-column">
          <li class="nav-item">
            <router-link :to="{name: 'farm'}">
              <i class="fa fa-first-order" aria-hidden="true">
                {{ $t('farm')}}
              </i>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'device'}">
              <i class="fa fa-first-order" aria-hidden="true">
                {{ $t('device')}}
              </i>
            </router-link>
          </li>
        </ul>
    </nav>
  </div>

</template>

<script>
import { mapGetters } from 'vuex'

export default {

  computed: mapGetters({
    user: 'auth/user'
  }),
}
</script>
