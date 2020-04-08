// CSS
require('./css/sass/theme.scss')

//JS
require('./js/utils.js')

import PageLoader from './vue/PageLoader.vue'
import draggable from 'vuedraggable'

Vue.component('PageLoader', PageLoader)
Vue.component(draggable)
