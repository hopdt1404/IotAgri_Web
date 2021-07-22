<script src="../router/routes.js"></script>
<template>
  <div v-if="user">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto flex-column">
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" :to="{name: 'farm'}">
              <Icon type="md-grid" />
                {{ $t('farm_nav')}}
            </router-link>
          </li>
          <li class="nav-item">
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
          <li class="nav-item">
            <router-link class="nav-link" active-class="active" :to="{name: 'agriculture_setting'}">
              <Icon type="md-aperture" />
              {{ $t('agriculture_setting')}}
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
}
</script>
