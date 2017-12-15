<script type="text/x-template" id="trois-pages-page">
  <div class="content">
    <div class="container-fluid">

      <!-- section modal-->
      <trois-pages-section-modal :url="url" ></trois-pages-section-modal>

      <section class="row">
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
