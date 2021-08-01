<template>
  <div v-if="user">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav flex-column margin-left-10">
          <li class="nav-item" v-if="user.group_user_id === 0">
            <router-link class="nav-link" active-class="active" :to="{name: 'farm'}">
              <Icon type="md-grid" />
                {{ $t('farm_nav')}}
            </router-link>
          </li>
          <li class="nav-item" v-if="user.group_user_id === 1">
            <router-link class="nav-link" active-class="active" :to="{name: 'device'}">
              <Icon type="logo-steam" />
                {{ $t('device_nav')}}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" :to="{name: 'plant'}">
              <Icon type="ios-ribbon" />
              {{ $t('plant_nav')}}
            </router-link>
          </li>
          <li class="nav-item" v-if="user.group_user_id === 0">
            <router-link class="nav-link" active-class="active" :to="{name: 'setting_agriculture'}">
              <Icon type="md-aperture" />
              {{ $t('setting_agriculture')}}
            </router-link>
          </li>
          <li class="nav-item" v-if="user.group_user_id === 0">
            <router-link class="nav-link" active-class="active" :to="{name: 'management_agriculture'}">
              <Icon type="ios-barcode" />
              {{ $t('management_agriculture')}}
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

  computed: mapGetters({
    user: 'auth/user'
  }),

  created() {
  }
}
</script>
