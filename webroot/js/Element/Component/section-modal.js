Vue.component('trois-pages-section-modal', {
  template: '#trois-pages-section-modal',
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
    window.aEventHub.$on('open-section-modal', this.open);
  },
  mounted: function(){
    //get section types here or not
  },
  methods: {

    close: function(){
      this.show = false;
      this.loading = false;
      window.aEventHub.$emit('page-section-modal-closed');
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
      this.$http.get(this.url+'admin/pages/section-types.json', {
        params: params,
        headers:{"Accept":"application/json","Content-Type":"application/json"}
      })
      .then(this.getSectionTypesSuccessCallback, this.errorCallback);
    },
    addSection: function(id){
      this.loading = true;
      this.$http.post(this.url+'admin/pages/sections/add.json',{
        "page_id":this.page.id,
        "section_type_id": id
      }, {
        headers:{"Accept":"application/json","Content-Type":"application/json"}
      })
      .then(this.createSectionTypeSuccessCallback, this.errorCallback);
    },
    createSectionType: function(){
      this.loading = true;
      this.$http.post(this.url+'admin/pages/section-types/add.json',{name:this.name}, {
        headers:{"Accept":"application/json","Content-Type":"application/json"}
      })
      .then(this.getSectionTypes, this.errorCallback);
    },
    createSectionTypeSuccessCallback: function(response){
      this.loading = false;
      this.page.sections.push(response.data.data);
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
      console.log(response);
    },
  }
});
