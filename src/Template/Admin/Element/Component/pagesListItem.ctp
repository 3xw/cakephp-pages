<!-- pagesListItem -->
<script type="text/x-template" id="trois-pages-list-item">
  <li>
    <div
      :class="{bold: isFolder}"
      @click="toggle"
      @dblclick="changeType">
      {{model.title}}
      <i class="material-icons">mode_edit</i>
      <i class="material-icons">info_outline</i>
      <i class="material-icons">delete_forever</i>
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
