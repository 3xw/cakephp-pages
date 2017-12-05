//trois-pages-list-item
Vue.component('trois-pages-list',{
  template: '#trois-pages-list',
  props: {
    url:String
  },
  data: function(){
    return {
      pages: {
        title: 'Pages',
        children: []
      },
    }
  },
  created: function(){
    this.pages.children = this.unflatten(window.troisPagesList);
  },
  methods: {
    unflatten: function(arr) {
      var tree = [],
      mappedArr = {},
      arrElem,
      mappedElem;

      // First map the nodes of the array to an object -> create a hash table.
      for(var i = 0, len = arr.length; i < len; i++) {
        arrElem = arr[i];
        mappedArr[arrElem.id] = arrElem;
        mappedArr[arrElem.id]['children'] = [];
      }

      for (var id in mappedArr) {
        if (mappedArr.hasOwnProperty(id)) {
          mappedElem = mappedArr[id];
          // If the element is not at the root level, add it to its parent array of children.
          if (mappedElem.parent_id) {
            mappedArr[mappedElem['parent_id']]['children'].push(mappedElem);
          }
          // If the element is at the root level, add it to first level elements array.
          else {
            tree.push(mappedElem);
          }
        }
      }
      return tree;
    }
  }
});
