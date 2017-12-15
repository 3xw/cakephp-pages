Vue.component('trois-pages-section-modal', {
  template: '#trois-pages-section-modal',
  data: function(){
    return {
      loading: true,
      show: false,
    };
  },
  props: {
    url:String,
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
    },
    getSections: function(){
      /*
      this.loading = true;
      var params = {page: this.pagination.current_page};

      // add uuid for restrictions
      params.uuid = this.settings.uuid;

      if(this.search){
        params.search = this.search;
      }
      if(this.tag){
        params.tag = this.tag;
      }
      if(this.sort.term){
        params.sort = this.sort.query.sort;
        params.direction = this.sort.query.direction;
      }

      if(!this.tag && !this.search){
        params.index = 'filter';
      }

      var options = {
        params: params,
        headers:{
          "Accept":"application/json",
          "Content-Type":"application/json"
        }
      };
      this.$http.get(this.url+'attachment/attachments.json', options)
      .then(this.successCallback, this.errorCallback);
      */
    },
    successCallback: function(response){
      this.loading = false;

    },
    errorCallback: function(response){
      this.loading = false;
      var message = ( response.data )? response.data.data.message : 'Your session is lost, please login again!';
      this.errors.push(message);
      console.log(response);
    },
  }
});
