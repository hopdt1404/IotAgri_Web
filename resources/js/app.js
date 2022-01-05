import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import ECharts from 'vue-echarts'
import { use } from 'echarts/core'
// //
// // import ECharts modules manually to reduce bundle size
import { CanvasRenderer } from 'echarts/renderers'
import { BarChart } from 'echarts/charts'
import {
  GridComponent,
  TooltipComponent
} from 'echarts/components'

import '~/plugins'
import '~/components'

// viewUI
import ViewUI from 'view-design'
import 'view-design/dist/styles/iview.css'

// Bootstap view
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// vuesax
import Vuesax from 'vuesax'

import 'vuesax/dist/vuesax.css'

import moment from 'moment'

import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'

Vue.config.productionTip = false

Vue.use(ViewUI)

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin) // Vuesax styles
Vue.use(Vuesax)
Vue.prototype.moment = moment
Vue.component('Multiselect', Multiselect)


// register globally (or you can do it locally)
use([
  CanvasRenderer,
  BarChart,
  GridComponent,
  TooltipComponent
])

Vue.component('v-chart', ECharts)
/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
