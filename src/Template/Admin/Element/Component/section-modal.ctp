<!-- browse -->
<script type="text/x-template" id="trois-pages-section-modal">
  <div id="trois-pages-section-modal" class="modal-mask" v-if="show" transition="modal">
    <div class="modal-wrapper">
      <div class="modal-container container">
        <div class="custom-modal-header">
          <?= __d('Trois/Pages','Section selection') ?>
        </div>
        <div class="custom-modal-body">

          <!-- WARNINGS -->
          <div v-for="(error, index) in errors" track-by="$index" class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close"  aria-label="Close" @click="errors = []" ><span aria-hidden="true">&times;</span></button>
            <strong><?= __d('Attachment','Watch out') ?>!</strong> {{error}}
          </div>

          <!-- loading -->
          <div v-if="loading" class="attachment-loading-container">
            <img v-bind:src="url+'attachment/img/loading.gif'" class="img-responsive" />
          </div>

          <!-- sectionTypes selection -->
          <div v-if="!loading" class="row" >
            <!-- list option -->
            <div class="col-xs-12">
              <table class="table table-bordered table-striped table-condensed table-hover">
                <!-- row -->
                <tr>
                  <th><?= __('Name') ?></th>
                  <th><?= __('Actions') ?></th>
                </tr>
                <tr v-for="(sectionType, index) in sectionTypes" :id="'section-type-'+index">
                  <td>
                    {{sectionType.name}}
                  </td>
                  <td>
                    <div class="btn-group">
                      <!-- data -->
                      <a href="#" class="btn btn-xs btn-fill btn-info" role="button" @click="addSection(sectionType.id)" >
                        <?= __d('Trois/Pages','Select') ?>
                      </a>
                    </div>
                  </td>

                </tr>

                <!-- add one -->
                <tr >
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon"><?= __d('Trois/Pages','Section type name') ?></span>
                      <input v-model="name" type="text" class="form-control" placeholder="">

                    </div>
                  </td>
                  <td>
                    <div class="btn-group">
                      <!-- data -->
                      <a href="#" class="btn btn-fill btn-success" role="button" @click="createSectionType()" >
                        <?= __d('Trois/Pages','Or create') ?>
                      </a>
                    </div>
                  </td>

                </tr>
              </table>
            </div>
          </div>

          <p></p>
          <div class="custom-modal-footer">
            <div class="btn-group">
              <button type="button" class="modal-default-button btn btn-fill btn-warning" @click="close()">
                <?= __d('Trois/Pages','Close') ?>
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</script>
