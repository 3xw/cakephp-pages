<template>
  <div class="content">
    <div class="container-fluid trois-pages">

      <!-- section modal-->
      <pages-section-modal :url="url" :page="page"></pages-section-modal>
      <draggable v-model="page.sections" @end="onSectionDragEnd">
        <section  v-for="(section, sectionIndex) in page.sections" :id="'section-'+sectionIndex" :data-section-index="sectionIndex" :data-id="section.id" class="trois-pages__section card">
          <div class="card-body">
            <h3 class="card-title">{{section.section_type.name}}</h3>
            <h6 class="card-subtitle mb-2 text-muted">section</h6>

            <!-- articles list -->

          <!--  v-sortable="{draggable:'.trois-pages__section__article', onEnd:onArticleDragEnd}" -->
          <draggable class="row" v-model="section.articles" @end="onArticleDragEnd">
            <article v-for="(article, index) in section.articles" :id="'article-'+index" :data-index="index" :data-section-index="sectionIndex" class="trois-pages__section__article col-6">
              <div class="card">
                <div class="card-body">

                  <h4 class="card-title">{{article.title}}</h4>
                  <h6 class="card-subtitle mb-2 text-muted">{{article.article_type.name}}</h6>

                  <!-- actions btns -->
                  <button @click="goToLocation(url+'admin/pages/Articles/edit/'+article.id)" type="button" name="button" class="btn btn-info btn-xs btn-fill">
                    <i class="material-icons">edit</i> Edit article
                  </button>
                  <!-- delete section -->
                  <form style="display:inline-block;" :id="'form-article-'+article.id" :action="url+'admin/pages/Articles/delete/'+article.id" method="post"></form>
                  <button @click="deleteArticle(section.id,article.id)" type="button" name="button" class="btn btn-danger btn-xs btn-fill">
                    <i class="material-icons">delete</i> Delete article
                  </button>
                </div>
              </div>
            </article>
          </draggable>


            <!-- add article -->
            <button @click="goToLocation(url+'admin/pages/Articles/add/'+section.id)" type="button" name="button" class="btn btn-primary btn-xs btn-fill">
              <i class="material-icons">add</i> Add a new article
            </button>
            <!-- delete section -->
            <form style="display:inline-block;" :id="'form-section-'+section.id" :action="url+'admin/pages/Sections/delete/'+section.id" method="post"></form>
            <button @click="deleteSection(section.id)" type="button" name="button" class="btn btn-danger btn-xs btn-fill">
              <i class="material-icons">delete</i> Delete section and articles
            </button>

          </div>
        </section>
      </draggable>
    </div> <!-- end container-fluid -->

    <div class="container-fluid">
      <!-- add section -->
      <button @click="openSectionModal()" type="button" name="button" class="btn btn-primary btn-xs btn-fill">
        <i class="material-icons">add</i> Add a new section
      </button>
    </div><!-- end container-fluid -->

  </div> <!-- end content -->
</template>
<script>
import SectionModal from './SectionModal.vue'
import { client } from '@/http/client.js'

export default
{
  name: 'pages-page',
  components: {
    'pages-section-modal': SectionModal
  },
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
    if(window.mainEventHub['page'] == undefined) window.mainEventHub['page'] = new Vue();
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
      window.mainEventHub['page'].$emit('open-section-modal')
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
      let data = new FormData()
      data.append('sections', JSON.stringify(this.page.sections));
      data.append('_csrfToken', window.getCsrfToken())
      client.post(this.url+'admin/pages/Pages/orderPageContent.json', data)
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
}
</script>
<style lang="scss" scoped>
</style>
