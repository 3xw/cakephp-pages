<template>
  <ul class="trois-pages-list">
    <pages-list-item class="trois-pages-list-item" :model="pages" :url="url"></pages-list-item>
  </ul>
</template>
<script>
import ListItem from './ListItem.vue'
export default {
  name: 'pages-list',
  components: {
    'pages-list-item': ListItem
  },
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
}
</script>
