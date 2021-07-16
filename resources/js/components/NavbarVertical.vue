<template>
  <div v-if="user">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <ul class="navbar-nav flex-column">
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" :to="{name: 'farm'}">
              <i class="fa fa-first-order" aria-hidden="true">
                {{ $t('farm_nav')}}
              </i>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" :to="{name: 'device'}">
              <i class="fa fa-first-order" aria-hidden="true">
                {{ $t('device_nav')}}
              </i>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" :to="{name: 'plant'}">
              <i class="fa fa-first-order" aria-hidden="true">
                {{ $t('plant_nav')}}
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
