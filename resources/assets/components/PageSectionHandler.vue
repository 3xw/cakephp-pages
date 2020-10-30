<template>
  <div id="page-sections-handler">
    <button class="btn btn-fill btn-xs btn-warning" @click="$hubEmit('page','section-add')" >Add new section</button>
  </div>
</template>
<script>
export default {
  template: '#page-sections-handler',
  data: function(){
    return {
      baseUrl: this.$root.$el.dataset.webroot
    };
  },
  props: {},
  created: function(){
    this.$hubOn('page','section-add', this.add);
  },
  mounted: function(){},
  methods: {
    add: function(){
      alert('section add');
    }
  }
}
</script>
