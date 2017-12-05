Vue.component('trois-pages-list-item', {
  template: '#trois-pages-list-item',
  props: {
    model: Object,
    url:String
  },
  data: function () {
    return {
      open: true
    }
  },
  computed: {
    isFolder: function () {
      return this.model.children &&
        this.model.children.length
    }
  },
  methods: {
    toggle: function () {
      if (this.isFolder) {
        this.open = !this.open
      }
    },
    changeType: function () {
      if (!this.isFolder) {
        Vue.set(this.model, 'children', [])
        this.addChild()
        this.open = true
      }
    },
    addChild: function () {
      this.model.children.push({
        title: 'new page'
      })
    },
    onDragEnd: function(evt){
      if(evt.oldIndex != evt.newIndex){
        this.swapChildren(evt.oldIndex, evt.newIndex);
      }
    },
    swapChildren: function(from, to)
    {
      var item = this.model.children.splice(from, 1 );
      this.model.children.splice((to < from)? to: to - 1, 0,  item[0]);

      // save
      this.$http.post(this.url+'/'+item[0].id+'.json',
      {
        from:from,
        to:to
      },{
        headers:{
          "Accept":"application/json",
          "Content-Type":"application/json"
        }
      })
      .then(this.editSuccessCallback, this.errorCallback);
    }
  }
})
