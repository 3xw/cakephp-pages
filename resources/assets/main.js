//JS
require('@/utils/window-events-hub-hooks.js')

import PageLoader from '@/components/PageLoader.vue'
import draggable from 'vuedraggable'

Vue.component('PageLoader', PageLoader)
Vue.component(draggable)
