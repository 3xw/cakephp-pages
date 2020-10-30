<template>
  <div id="pages-section-modal" class="modal-mask" v-if="show" transition="modal">
    <div class="modal-wrapper">
      <div class="modal-container container">
        <div class="custom-modal-header">
          Section selection
        </div>
        <div class="custom-modal-body">

          <!-- WARNINGS -->
          <div v-for="(error, index) in errors" track-by="$index" class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close"  aria-label="Close" @click="errors = []" ><span aria-hidden="true">&times;</span></button>
            <strong>Watch out!</strong> {{error}}
          </div>

          <!-- loading -->
          <div v-if="loading" class="attachment-loading-container">
            <img v-bind:src="url+'img/admin/loading.gif'" class="img-responsive" />
          </div>

          <!-- sectionTypes selection -->
          <div v-if="!loading" class="row" >
            <!-- list option -->
            <div class="col-xs-12">
              <table class="table table-bordered table-striped table-condensed table-hover">
                <!-- row -->
                <tr>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
                <tr v-for="(sectionType, index) in sectionTypes" :id="'section-type-'+index">
                  <td>
                    {{sectionType.name}}
                  </td>
                  <td>
                    <div class="btn-group">
                      <!-- data -->
                      <a href="#" class="btn btn-xs btn-fill btn-info" role="button" @click="addSection(sectionType.id)" >
                        Select
                      </a>
                    </div>
                  </td>

                </tr>

                <!-- add one -->
                <tr >
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">Section type name &nbsp;&nbsp;</span>
                      <input v-model="name" type="text" class="form-control" placeholder="">

                    </div>
                  </td>
                  <td>
                    <div class="btn-group">
                      <!-- data -->
                      <a href="#" class="btn btn-xs btn-fill btn-success" role="button" @click="createSectionType()" >
                        Or create
                      </a>
                    </div>
                  </td>

                </tr>
              </table>
            </div>
          </div>

          <p></p>
          <div class="custom-modal-footer">
            <div class="btn-group">
              <button type="button" class="modal-default-button btn btn-fill btn-warning" @click="close()">
                Close
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'pages-section-modal',
  data: function(){
    return {
      name: '',
      loading: true,
      show: false,
      errors: [],
      sectionTypes: [],
      pagination: {
        "page_count": 1,
        "current_page": 1,
        "has_next_page": false,
        "has_prev_page": false,
        "count": 0,
        "limit": 100
      }
    };
  },
  props: {
    url:String,
    page: Object,
  },
  created: function(){
    if(window.mainEventHub['page'] == undefined) window.mainEventHub['page'] = new Vue();
    window.mainEventHub['page'].$on('open-section-modal', this.open);
  },
  mounted: function(){
    //get section types here or not
  },
  methods: {

    close: function(){
      this.show = false;
      this.loading = false;
      window.mainEventHub['page'].$emit('page-section-modal-closed');
    },
    open: function(){
      this.loading = true;
      this.show = true;
      this.getSectionTypes();
    },
    getSectionTypes: function(){
      this.name = '';
      this.loading = true;
      var params = {page: this.pagination.current_page};
      this.$http.get(this.url+'admin/pages/SectionTypes.json', {
        params: params,
        headers:{"Accept":"application/json","Content-Type":"application/json"}
      })
      .then(this.getSectionTypesSuccessCallback, this.errorCallback);
    },
    addSection: function(id){
      this.loading = true;
      let data = new FormData()
      data.append('page_id', this.page.id)
      data.append('section_type_id', id)
      this.$http.post(this.url+'admin/pages/Sections/add.json', data, {
        headers:{"Accept":"application/json","Content-Type":"application/json"}
      })
      .then(this.createSectionTypeSuccessCallback, this.errorCallback);
    },
    createSectionType: function(){
      this.loading = true;
      let data = new FormData()
      data.append('name', this.name)
      this.$http.post(this.url+'admin/pages/SectionTypes/add.json', data, {
        headers:{"Accept":"application/json","Content-Type":"application/json"}
      })
      .then(this.getSectionTypes, this.errorCallback);
    },
    createSectionTypeSuccessCallback: function(response){
      this.loading = true;
      console.log(response);
      this.$http.get(this.url+'admin/pages/Sections/view/'+response.data.data.id+'.json',{
        headers:{"Accept":"application/json","Content-Type":"application/json"}
      })
      .then(this.getSectionSuccessCallback, this.errorCallback);
    },
    getSectionSuccessCallback: function(response){
      this.loading = false;
      var section = response.data.data;
      this.page.sections.push(section);
      this.close();
    },
    getSectionTypesSuccessCallback: function(response){
      this.loading = false;
      this.sectionTypes = response.data.data;
      this.pagination = response.data.pagination;

    },
    errorCallback: function(response){
      this.loading = false;
      var message = ( response.data )? response.data.data.message : 'Your session is lost, please login again!';
      this.errors.push(message);
    },
  }
}
</script>
