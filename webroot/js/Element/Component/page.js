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
    this.page = window.troisPage;
  },
  computed: {

  },
  methods: {
    openSectionModal: function(){
      window.aEventHub.$emit('open-section-modal')
    }
  }
})
