<script type="text/x-template" id="trois-pages-page">
  <div class="content">
    <div class="container-fluid">

      <!-- section modal-->
      <trois-pages-section-modal :url="url" :page="page"></trois-pages-section-modal>

      <section  v-for="(section, index) in page.sections" :id="'section-'+index" class="row">
        <h3>{{section.section_type.name}}</h3>
        <!-- add article -->
        <article class="col-6">
          <i class="material-icons">add</i>
        </article>
      </section>

      <!-- add section -->
      <section class="row">
        <button @click="openSectionModal()" type="button" name="button" class="btn btn-info btn-sm btn-fill">
          <i class="material-icons">add</i>
        </button>
      </section>

    </div> <!-- end container-fluid -->
  </div> <!-- end content -->
</script>
