<script type="text/x-template" id="trois-pages-page">
  <div class="content">
    <div class="container-fluid trois-pages" v-sortable="{draggable:'.trois-pages__section', onEnd:onSectionDragEnd}">

      <!-- section modal-->
      <trois-pages-section-modal :url="url" :page="page"></trois-pages-section-modal>

      <section  v-for="(section, sectionIndex) in page.sections" :id="'section-'+sectionIndex" :data-section-index="sectionIndex" :data-id="section.id" class="trois-pages__section card">
        <div class="card-body">
          <h3 class="card-title">{{section.section_type.name}}</h3>
          <h6 class="card-subtitle mb-2 text-muted">section</h6>

          <!-- articles list -->
          <div class="row" v-sortable="{draggable:'.trois-pages__section__article', onEnd:onArticleDragEnd}">
            <article v-for="(article, index) in section.articles" :id="'article-'+index" :data-index="index" :data-section-index="sectionIndex" class="trois-pages__section__article col-6">
              <div class="card">
                <div class="card-body">

                  <h4 class="card-title">{{article.title}}</h4>
                  <h6 class="card-subtitle mb-2 text-muted">{{article.article_type.name}}</h6>

                  <!-- actions btns -->
                  <button @click="goToLocation(url+'admin/pages/articles/edit/'+article.id)" type="button" name="button" class="btn btn-info btn-xs btn-fill">
                    <i class="material-icons">edit</i> <?= __d('Trois/Pages','Edit artcile') ?>
                  </button>
                  <!-- delete section -->
                  <form style="display:inline-block;" :id="'form-article-'+article.id" :action="url+'admin/pages/articles/delete/'+article.id" method="post"></form>
                  <button @click="deleteArticle(section.id,article.id)" type="button" name="button" class="btn btn-danger btn-xs btn-fill">
                    <i class="material-icons">delete</i> <?= __d('Trois/Pages','Delete article') ?>
                  </button>
                </div>
              </div>
            </article>
          </div>

          <!-- add article -->
          <button @click="goToLocation(url+'admin/pages/articles/add/'+section.id)" type="button" name="button" class="btn btn-primary btn-xs btn-fill">
            <i class="material-icons">add</i> <?= __d('Trois/Pages','Add a new artcile') ?>
          </button>
          <!-- delete section -->
          <form style="display:inline-block;" :id="'form-section-'+section.id" :action="url+'admin/pages/sections/delete/'+section.id" method="post"></form>
          <button @click="deleteSection(section.id)" type="button" name="button" class="btn btn-danger btn-xs btn-fill">
            <i class="material-icons">delete</i> <?= __d('Trois/Pages','Delete section and articles') ?>
          </button>

        </div>
      </section>
    </div> <!-- end container-fluid -->

    <div class="container-fluid">
      <!-- add section -->
      <button @click="openSectionModal()" type="button" name="button" class="btn btn-primary btn-xs btn-fill">
        <i class="material-icons">add</i> <?= __d('Trois/Pages','Add a new section') ?>
      </button>
    </div><!-- end container-fluid -->

  </div> <!-- end content -->
</script>
