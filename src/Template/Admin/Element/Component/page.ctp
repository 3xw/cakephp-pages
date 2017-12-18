<script type="text/x-template" id="trois-pages-page">
  <div class="content">
    <div class="container-fluid trois-pages">

      <!-- section modal-->
      <trois-pages-section-modal :url="url" :page="page"></trois-pages-section-modal>

      <section  v-for="(section, index) in page.sections" :id="'section-'+index" class="row">
        <h3>{{section.section_type.name}}</h3>
        <!-- add article -->
        <article class="col-6">
          <a :href="url+'admin/pages/articles/add/'+section.id" type="button" name="button" class="btn btn-info btn-sm btn-fill">
            <i class="material-icons">add</i> <?= __d('Trois/Pages','Add a new artcile') ?>
          </a>
          <button @click="openSectionModal()" type="button" name="button" class="btn btn-danger btn-sm btn-fill">
            <i class="material-icons">delete</i> <?= __d('Trois/Pages','Delete section and articles') ?>
          </button>
        </article>
      </section>

      <!-- add section -->
      <section class="row">
        <div class="btn-group">
          <button @click="openSectionModal()" type="button" name="button" class="btn btn-info btn-sm btn-fill">
            <i class="material-icons">add</i> <?= __d('Trois/Pages','Add a new section') ?>
          </button>

        </div>
      </section>

    </div> <!-- end container-fluid -->
  </div> <!-- end content -->
</script>
