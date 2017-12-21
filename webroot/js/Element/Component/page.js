Vue.component('trois-pages-page', {
  template: '#trois-pages-page',
  props: {
    url:String
  },
  data: function () {
    return {
      page: {},
      section: {},
      article: {},
    }
  },
  created: function(){
    if(window.aEventHub['page'] == undefined) window.aEventHub['page'] = new Vue();
    this.page = window.troisPage;
  },
  computed: {

  },
  methods: {
    onSectionDragEnd: function(evt){
      var self = this;
      $('.trois-pages section')
      .each(function(index, elem){
        var sectionIndex = $(elem).data('section-index');
        self.page.sections[sectionIndex].order = index;
      });
      this.saveNewOrder();
    },
    onArticleDragEnd: function(evt){
      var sectionIndex = $('#'+evt.item.id).data('section-index');
      var self = this;
      $('#section-'+sectionIndex+' .trois-pages__section__article')
      .each(function(index, elem){
        var articleIndex = $(elem).data('index');
        self.page.sections[sectionIndex].articles[articleIndex].order = index;
      });
      this.saveNewOrder();
    },
    goToLocation: function(location){
      window.location = location;
    },
    openSectionModal: function(){
      window.aEventHub['page'].$emit('open-section-modal')
    },
    getSection: function(id){
      this.section = null;
      for(var i in this.page.sections){
        if(this.page.sections[i].id == id){
          this.sectionId = i;
          this.section = this.page.sections[i];
          return this.section;
        }
      }
    },
    getArtcile: function(sectionId, artcileId){
      this.getSection(sectionId);
      this.article = null;
      for(var i in this.section.articles){
        if(this.section.articles[i].id == artcileId){
          this.articleId = i;
          this.article = this.section.articles[i];
          return this.article;
        }
      }
    },
    deleteSection: function(id){
      this.getSection(id);
      if(confirm('Are you sure you want to delete section: "'+this.section.section_type.name+'" ?'))
      {
        $('#form-section-'+id).submit();
      }
    },
    deleteArticle: function(sectionId, artcileId){
      this.getArtcile(sectionId, artcileId);
      if(confirm('Are you sure you want to delete artcile: "'+this.article.title+'" ?'))
      {
        $('#form-article-'+artcileId).submit();
      }
    },
    saveNewOrder: function(){
      this.$http.post(this.url+'admin/pages/pages/order-page-content.json',{sections:this.page.sections}, {
        headers:{"Accept":"application/json","Content-Type":"application/json"}
      })
      .then(this.saveNewOrderSuccess, this.errorCallback);
    },
    saveNewOrderSuccess: function(response){
      console.log(response);
    },
    errorCallback: function(response){
      console.log(response);
      alert('An error occured!');
    },
  }
})
