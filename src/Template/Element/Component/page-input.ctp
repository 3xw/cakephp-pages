<script type="text/x-template" id="page-input">
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
</script>
