Vue.component('page-articles-handler', {
  template: '#page-articles-handler',
  data: function(){
    return {
      baseUrl: this.$root.$el.dataset.webroot
    };
  },
  props: {},
  created: function(){
    this.$hubOn('page','article-add', this.add);
  },
  mounted: function(){},
  methods: {
    add: function(){
      alert('article add');
    }
  }
});
