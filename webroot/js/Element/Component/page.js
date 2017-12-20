Vue.component('trois-pages-page', {
  template: '#trois-pages-page',
  props: {
    url:String
  },
  data: function () {
    return {
      page: {},
      section: {},
      article: {}
    }
  },
  created: function(){
    if(window.aEventHub['page'] == undefined) window.aEventHub['page'] = new Vue();
    this.page = window.troisPage;
  },
  computed: {

  },
  methods: {
    onArticleDragEnd: function(){

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
          this.article = this.section.articles[i];
          return this.article;
        }
      }
    },
    deleteSection: function(id){
      this.getSection(id);
      if(confirm('Are you sur you want to delete section: "'+this.section.section_type.name+'" ?')){

      }
    },
    deleteArticle: function(sectionId, artcileId){
      this.getArtcile(sectionId, artcileId);
      if(confirm('Are you sur you want to delete artcile: "'+this.article.title+'" ?')){

      }
    }
  }
})
