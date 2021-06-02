//JS
require('./utils/window-events-hub-hooks.js')

import PageLoader from './components/PageLoader.vue'
import draggable from 'vuedraggable'



const
install = function(Vue, { store })
{
  Vue.component('PageLoader', PageLoader)
  Vue.component(draggable)
}

// EXPORT
export default
{
  version: '4.0.0',
  install,
}
