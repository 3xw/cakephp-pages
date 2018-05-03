Vue.component('page-section', {
  template: '#page-section',
  props: {
    id: Number,
    i: Number,
  },
  data: function(){
    return {
      baseUrl: this.$root.$el.dataset.webroot,
      content: '',
    };
  },
  created: function(){
    this.baseUrl = this.$root.$el.dataset.webroot;
    this.loadSection(this.id, this.i);
  },
  mounted: function(){},
  methods: {
    loadSection: function(id, key){
      return this.$http.get(this.baseUrl+'admin/pages/sections/view/'+id+'/'+key)
      .then(this.loadSectionSuccess, this.error);
    },
    loadSectionSuccess: function(request){
      this.content = request.data;
    },
    error: function(){
      alert('An error occured');
    }
  }
});
