<template>
  <div id="page-input">

    <label :for="name">{{name}} {{language}}</label>

    <input
    v-if="type == 'text'"
    :id="'a-'+language+'-header'"
    type="text" class="form-control"
    v-model="model._translations[language]? model._translations[language][name]: model[name]"
    :name="model._translations[language]? '_translations['+language+']['+name+']': name">

    <textarea
    v-if="type == 'textarea'"
    :id="'a-'+language+'-header'"
    type="text" class="form-control"
    v-model="model._translations[language]? model._translations[language][name]: model[name]"
    :name="model._translations[language]? '_translations['+language+']['+name+']': name"></textarea>

  </div>
</template>
<script>
export default {
  name: 'page-input',
  props: {
    name: String,
    type: String,
    model: Object,
    language: String
  },
}
</script>
<style lang="scss" scoped>
</style>
