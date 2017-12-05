<!-- pagesListItem -->
<script type="text/x-template" id="trois-pages-list-item">
  <li>
    <div
      :class="{bold: isFolder}"
      @click="toggle"
      @dblclick="changeType">
      {{model.title}}
      <span v-if="isFolder">[{{open ? '-' : '+'}}]</span>
    </div>
    <ul v-show="open" v-if="isFolder">
      <trois-pages-list-item
        class="trois-pages-list-item"
        v-for="model in model.children"
        :key="model.id"
        :model="model">
      </trois-pages-list-item>
      <li class="add" @click="addChild">+</li>
    </ul>
  </li>
</script>
