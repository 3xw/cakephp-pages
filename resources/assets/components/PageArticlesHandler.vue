<template>
  <div id="page-articles-handler" class="modal-mask" v-if="show" transition="modal">
    <div class="modal-wrapper">
      <div class="modal-container container">

        <!-- header -->
        <div class="custom-modal-header">
          <span v-if="!article.id">Add article</span>
          <span v-if="article.id">Edit article</span>
        </div>

        <!-- body -->
        <div class="custom-modal-body">

          <!-- WARNINGS -->
          <div v-for="(error, index) in errors" track-by="$index" class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close"  aria-label="Close" @click="errors = []" ><span aria-hidden="true">&times;</span></button>
            <strong>Watch out</strong> {{error}}
          </div>

          <!-- INPUTS -->
          <div v-if="show">

            <!-- _translations[en_GB][title] -->
            <div v-if="languages">
              <ul class="nav nav-tabs" role="tablist">
                <li v-for="(language, index) in languages" v-bind:class="{ 'active': language ==  defaultLocale}" role="presentation">
                  <a :href="'#a-'+language" :aria-controls="'a-'+language" role="tab" data-toggle="tab" >
                    {{language}}
                  </a>
                </li>
              </ul>
              <div class="tab-content">

                <!-- other locales -->
                <div v-for="(language, index) in languages" role="tabpanel" class="tab-pane" :class="language == defaultLocale? 'active': ''" :id="'a-'+language">

                  <!-- fields -->
                  <page-input v-for="(field, index) in fields" :key="field.name" :name="field.name" :type="field.type" :model="article" :langauge="language"></page-input>

                </div>

              </div>
            </div>

            <!-- no translate -->
            <div v-if="!languages">

              <!-- fields -->
              <page-input v-for="(field, index) in fields" :key="field.name" :name="field.name" :type="field.type" :model="article" :langauge="null"></page-input>

            </div>

          </div><!-- END INPUTS -->

          <p></p>

          <!-- FOOTER -->
          <div class="custom-modal-footer">
            <div class="btn-group">
              <button type="button" class="modal-default-button btn btn-success" @click="save">
                Save
              </button>
              <button type="button" class="modal-default-button btn btn-warning" @click="close">
                Close
              </button>
            </div>
          </div><!-- END FOOTER -->

        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'page-articles-handler',
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
}
</script>
<style lang="scss" scoped>
</style>
