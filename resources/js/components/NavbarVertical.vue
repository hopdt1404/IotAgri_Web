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
<!--          <li class="nav-item dropdown">-->
<!--              <a class="nav-link text-dark"-->
<!--                 href="#" role="button" data-toggle="dropdown"-->
<!--                 aria-haspopup="true" aria-expanded="false"-->
<!--              >-->
<!--                <Icon type="ios-ribbon" />-->
<!--                {{ $t('plant_nav')}}-->
<!--              </a>-->
<!--            <div class="dropdown-menu">-->
<!--              <router-link :to="{name: 'plant'}" class="dropdown-item pl-3">-->
<!--                <Icon type="md-snow" />-->
<!--                {{ $t('plant_info') }}-->
<!--              </router-link>-->
<!--              <div class="dropdown-divider" />-->
<!--              <router-link :to="{name: 'plant-state'}" class="dropdown-item pl-3">-->
<!--                <Icon type="ios-stats" />-->
<!--                {{ $t('plant_state') }}-->
<!--              </router-link>-->
<!--            </div>-->

<!--          </li>-->
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
