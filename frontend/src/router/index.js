/**
 * router/index.ts
 *
 * Automatic routes for `./src/pages/*.vue`
 */

import { createRouter, createWebHistory } from 'vue-router/auto'
import { setupLayouts } from 'virtual:generated-layouts'

import Default from '@/layouts/default.vue'
import AdminLayout from '@/layouts/AdminLayout.vue';
import HistotechLayout from '@/layouts/HistotechLayout.vue';
import PathologistLayout from '@/layouts/PathologistLayout.vue';

import { routes as autoRoutes } from 'vue-router/auto-routes'

function isLoggedIn() {
  const token = localStorage.getItem('token');
  const expiresAt = localStorage.getItem('token_expiry');

  if (!token || !expiresAt) return false;

  const now = new Date().getTime();
  const expiryTime = new Date(expiresAt).getTime();

  if (now > expiryTime) {
    localStorage.removeItem('token');
    localStorage.removeItem('token_expiry');
    localStorage.removeItem('userRole');
    localStorage.removeItem('user_id');
    return false;
  }

  return true; 
}


function requireAuth(to, from, next) {
  const isAuthenticated = isLoggedIn();
  const LoggedinUserRole = parseInt(localStorage.getItem('userRole'));

  if (to.meta.requiresAuth && !isAuthenticated) {
    return next({ name: 'Login' });
  }

  if (to.name === 'Login' && isAuthenticated) {
    switch (LoggedinUserRole) {
      case 0:
        return next({ name: 'AdminHome' });
      case 1:
        return next({ name: 'HistotechHome' });
      case 2:
        return next({ name: 'PathologistHome' });
      default:
        return next();
    }
  }

  const roleRouteMap = {
    AdminHome: 0,
    HistotechHome: 1,
    PathologistHome: 2,
  };

  const requiredRole = roleRouteMap[to.name];
  if (requiredRole !== undefined && LoggedinUserRole !== requiredRole) {
    return next({ name: 'Unauthorized' });
  }

  next();
}


const routes = [
  {
    path: '/',
    name: 'Login',
    component: () => import('@/views/auth/Login.vue'),
    meta: {
      layout: Default,
      title: 'Login'
    }
  },
  {
    path: '/unauthorized',
    name: 'Unauthorized',
    component: () => import('@/views/auth/UnauthorizedPage.vue'),
    meta: {
      title: 'Unauthorized'
    }
  },
  {
    path: '/admin',
    component: AdminLayout,
    meta: {
      requiresAuth: true,
      title: 'Admin Dashboard'
    },
    children: [
      {
        path: '',
        name: 'AdminHome',
        component: () => import('@/views/admin/AdminHome.vue'),
      },
      {
        path: 'units',
        name: 'AdminUnitList',
        component: () => import('@/views/units/UnitPage.vue'),
        meta: {
          title: 'Units'
        }
      },
      {
        path: 'configurations',
        name: 'Configuration',
        component: () => import('@/views/configurations/ConfigurationPage.vue'),
        meta: {
          title: 'Configurations'
        }
      },
      {
        path: 'general_report',
        name: 'AdminGeneralReport',
        component: () => import('@/views/analytics/GeneralReportPage.vue'),
        meta: {
          title: 'General Report'
        }
      },
      {
        path: 'audit_logs',
        name: 'AdminAuditLogs',
        component: () => import('@/views/audit-logs/AuditLogsPage.vue'),
        meta: {
          title: 'Audit Logs'
        }
      },
    ]
  },
  {
    path: '/histotech',
    component: HistotechLayout,
    meta: {
      requiresAuth: true,
      title: 'Histotech Dashboard'
    },
    children: [
      {
        path: '',
        name: 'HistotechHome',
        component: () => import('@/views/histotech/HistotechHome.vue'),
        meta: {
          title: 'Histotech'
        }
      },
      {
        path: 'general_report',
        name: 'HistotechGeneralReport',
        component: () => import('@/views/analytics/GeneralReportPage.vue'),
        meta: {
          title: 'General Report'
        }
      },
      
    ]
  },
  {
    path: '/pathologist',
    component: PathologistLayout,
    meta: {
      requiresAuth: true,
      title: 'Pathologist Dashboard'
    },
    children: [
      {
        path: '',
        name: 'PathologistHome',
        component: () => import('@/views/pathologist/PathologistHome.vue'),
      },
      {
        path: 'general_report',
        name: 'PathologistGeneralReport',
        component: () => import('@/views/analytics/GeneralReportPage.vue'),
        meta: {
          title: 'General Report'
        }
      },
      {
        path: 'audit_logs',
        name: 'PathologistAuditLogs',
        component: () => import('@/views/audit-logs/AuditLogsPage.vue'),
        meta: {
          title: 'Audit Logs'
        }
      },
    ]
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: setupLayouts(routes),
})

router.beforeEach(requireAuth);

router.afterEach((to) => {
  const baseTitle = 'WebHistopath -';

  const routeTitle = to.meta?.title ?? to.name

  document.title = `${baseTitle} ${routeTitle}`;
});

// Workaround for https://github.com/vitejs/vite/issues/11804
router.onError((err, to) => {
  if (err?.message?.includes?.('Failed to fetch dynamically imported module')) {
    if (!localStorage.getItem('vuetify:dynamic-reload')) {
      console.log('Reloading page to fix dynamic import error')
      localStorage.setItem('vuetify:dynamic-reload', 'true')
      location.assign(to.fullPath)
    } else {
      console.error('Dynamic import error, reloading page did not fix it', err)
    }
  } else {
    console.error(err)
  }
})

router.isReady().then(() => {
  localStorage.removeItem('vuetify:dynamic-reload')
})

export default router
