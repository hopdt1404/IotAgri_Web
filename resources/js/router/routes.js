function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },
  {
    path: '/farm',
    name: 'farm',
    component: page('farm')
  },
  {
    path: '/management-area-in-farm/:farm_id',
    name: 'management-area-in-farm',
    component: page('managementAreaInFarm')
  },
  {
    path: '/device',
    name: 'device',
    component: page('device')
  },
  {
    path: '/plant',
    name: 'plant',
    component: page('plant')
  },
  {
    path: '/setting-agriculture',
    name: 'setting_agriculture',
    component: page('agricultureSetting')
  },
  {
    path: '/management-agriculture',
    name: 'management_agriculture',
    component: page('managementAgriculture')
  },
  {
    path: '/analytics-data',
    name: 'analytics_data',
    component: page('analyticsData')
  },

  { path: '*', component: page('errors/404.vue') }
]
