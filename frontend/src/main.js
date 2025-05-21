/**
 * main.js
 *
 * Bootstraps Vuetify and other plugins then mounts the App`
 */

// Plugins
import { registerPlugins } from '@/plugins'

// Components
import App from './App.vue'
import 'vuetify/styles'

// Composables
import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import '@fortawesome/fontawesome-free/css/all.css';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const vuetify = createVuetify({
    theme: {
      defaultTheme: 'light',
    },
    icons: {
    defaultSet: 'fa',
    sets: {
      fa: {
        component: (props) => h('i', { ...props, class: `fa ${props.icon}` }),
      },
    },
  },
})

const app = createApp(App)

registerPlugins(app)

app.use(vuetify)
app.use(VueSweetalert2)
app.mount('#app')
