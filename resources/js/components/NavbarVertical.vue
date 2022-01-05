<template>
  <div v-if="user">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav flex-column margin-left-10">
          <li class="nav-item" v-if="user.group_user_id === 0">
            <router-link class="nav-link" active-class="active" to="farm">
              <Icon type="md-grid" />
                {{ $t('farm_nav')}}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" to="device">
              <Icon type="logo-steam" />
                {{ $t('device_nav')}}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" to="plant">
              <Icon type="ios-ribbon" />
              {{ $t('plant_nav')}}
            </router-link>
          </li>
          <li class="nav-item" v-if="user.group_user_id === 0">
            <router-link class="nav-link" active-class="active" to="setting-agriculture">
              <Icon type="md-aperture" />
              {{ $t('setting_agriculture')}}
            </router-link>
          </li>
          <li class="nav-item" v-if="user.group_user_id === 0">
            <router-link class="nav-link" active-class="active" to="management-agriculture">
              <Icon type="ios-barcode" />
              {{ $t('management_agriculture')}}
            </router-link>
          </li>
          <li class="nav-item" v-if="user.group_user_id === 0">
            <router-link class="nav-link" active-class="active" to="analytics-data">
              <Icon type="md-stats" />
              {{ $t('analytics-data')}}
            </router-link>
          </li>

        </ul>
      </div>
    </nav>
  </div>

</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data() {
    return {
    }
  },

  computed: mapGetters({
    user: 'auth/user'
  }),

  created() {
  },
  methods: {
  }
}
</script>
