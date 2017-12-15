<!-- pagesListItem -->
<script type="text/x-template" id="trois-pages-list-item">
  <li>
    <div
      :class="{bold: isFolder}"
      @click="toggle"
      @dblclick="changeType">
      {{model.title}}

      <!-- MANAGE PAGE CONTENT -->
      <a v-if="model.id" :href="url+'admin/pages/pages/manage/'+model.id">
        <i class="material-icons">mode_edit</i>
      </a>

      <!-- EDIT PAGE -->
      <a v-if="model.id" :href="url+'admin/pages/pages/edit/'+model.id">
        <i class="material-icons">info_outline</i>
      </a>

      <!-- DELETE -->
      <form v-if="model.id" style="display:inline-block;" :id="'form-'+model.id" :action="url+'admin/pages/pages/edit/'+model.id" method="post"></form>
      <i v-if="model.id" class="material-icons" @click="deleteItem">delete_forever</i>

      <span v-if="isFolder">[{{open ? '-' : '+'}}]</span>
    </div>
    <ul v-show="open" v-if="isFolder" v-sortable="{draggable:'.trois-pages-list-item', onEnd:onDragEnd}">
      <trois-pages-list-item
        class="trois-pages-list-item"
        v-for="model in model.children"
        :key="model.id"
        :model="model"
        :url="url">
      </trois-pages-list-item>
      <!--<li class="add" @click="addChild">+</li>-->
    </ul>
  </li>
</script>
