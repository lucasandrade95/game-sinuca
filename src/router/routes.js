
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/pontuacoes.vue') },
      { path: '/pontuacoes', component: () => import('pages/pontuacoes.vue') },
      { path: '/times', component: () => import('pages/times.vue') },
      { path: '/tabela', component: () => import('pages/tabela.vue') },
      { path: '/help', component: () => import('pages/Help.vue') }
    ]
  }
]

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue')
  })
}

export default routes
