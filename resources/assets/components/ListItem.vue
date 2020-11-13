<template>
  <li>
    <div
      :class="{bold: isFolder}"
      @click="toggle"
      @dblclick="changeType">

      <div v-if="model.id" class="trois-pages-list-item-title">
        <div class="trois-pages-list-openener">
          <span v-if="isFolder">
            <i v-if="open" class="material-icons">expand_more</i>
            <i v-else class="material-icons">chevron_right</i>
          </span>
        </div>
        <i class="material-icons">description</i> {{model.title}}
      </div>

      <div class="trois-pages-list-item-action">
        <!-- MANAGE PAGE CONTENT -->
        <a v-if="model.id" :href="url+'admin/pages/Pages/manage/'+model.id">
          <i class="material-icons">mode_edit</i>
        </a>

        <!-- EDIT PAGE -->
        <a v-if="model.id" :href="url+'admin/pages/Pages/edit/'+model.id">
          <i class="material-icons">info_outline</i>
        </a>

        <!-- DELETE -->
        <form v-if="model.id" style="display:inline-block;" :id="'form-'+model.id" :action="url+'admin/pages/Pages/delete/'+model.id" method="post"></form>
        <i v-if="model.id" class="material-icons" @click="deleteItem">delete_forever</i>
      </div>
    </div>
    <ul v-show="open" v-if="isFolder" >
      <pages-list-item
        class="trois-pages-list-item"
        v-for="model in model.children"
        :key="model.id"
        :model="model"
        :url="url">
      </pages-list-item>
    </ul>
  </li>
</template>

<script>
import { client } from '@/http/client.js'

export default
{
  name: 'pages-list-item',
  props: {
    model: Object,
    url:String
  },
  data: function () {
    return {
      open: (this.model.parent_id == undefined) ? true : false
    }
  },
  computed: {
    isFolder: function () {
      return this.model.children &&
        this.model.children.length
    }
  },
  mounted: function () {

  },
  methods: {
    deleteItem: function(){
      if (confirm("Are you sure you want to delete '"+this.model.title+"' ?")){
        document.getElementById('form-'+this.model.id).submit();
      }
    },
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
    /*onDragEnd: function(evt){
      if(evt.oldIndex != evt.newIndex){
        this.swapChildren(evt.oldIndex, evt.newIndex);
      }
    },
    swapChildren: function(from, to)
    {
      var item = this.model.children.splice(from, 1 );
      this.model.children.splice((to < from)? to: to - 1, 0,  item[0]);

      // save
      client.post(this.url+'admin/pages/pages/order/'+item[0].id+'.json',
      {from:from,to:to,_csrfToken:window.getCsrfToken()},
      {headers:{"Accept":"application/json","Content-Type":"application/json"}})
      .then(this.editSuccessCallback, this.errorCallback);
    }*/
  }
}
</script>
