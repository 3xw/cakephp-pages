Vue.component('page-articles-handler', {
  template: '#page-articles-handler',
  props: {
    languages: Array,
    defaultLocale: String
  },
  data: function(){
    return {
      baseUrl: this.$root.$el.dataset.webroot,
      article: {},
      errors: [],
      show: false,
      options: {headers:{"Accept":"application/json", "Content-Type":"application/json"}},
      fields: [
        {name: 'title', type: 'text'},
        {name: 'header', type: 'text'},
        {name: 'body', type: 'textarea'},
      ]
    };
  },
  created: function(){
    this.$hubOn('page','article-edit', this.edit);
  },
  mounted: function(){},
  methods: {
    edit: function(id){
      this.article.id = id;
      this.$http.get(this.baseUrl+'admin/pages/articles/edit/'+this.article.id, this.options)
      .then(this.loadArticleSuccess, this.error);
    },
    add: function(){
      alert('article add');
    },
    save: function(){
      alert('save!!');
      this.close();
    },
    loadArticleSuccess: function(request){
      this.article = request.body.article;
      this.open();
    },
    error: function(request){
      alert('an error occured!');
    },
    open: function(){
      this.show = true;
    },
    close: function(){
      this.show = false;
    },
  }
});
