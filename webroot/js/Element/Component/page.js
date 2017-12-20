Vue.component('trois-pages-page', {
  template: '#trois-pages-page',
  props: {
    url:String
  },
  data: function () {
    return {
      page: {}
    }
  },
  created: function(){
    if(window.aEventHub['page'] == undefined) window.aEventHub['page'] = new Vue();
    this.page = window.troisPage;
  },
  computed: {

  },
  methods: {
    openSectionModal: function(){
      window.aEventHub['page'].$emit('open-section-modal')
    }
  }
})
