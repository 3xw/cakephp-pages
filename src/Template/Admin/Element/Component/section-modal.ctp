<!-- browse -->
<script type="text/x-template" id="trois-pages-section-modal">
  <div id="trois-pages-section-modal" class="modal-mask" v-if="show" transition="modal">
    <div class="modal-wrapper">
      <div class="modal-container container">
        <div class="custom-modal-header">
          <?= __d('Trois/Pages','Section selection') ?>
        </div>
        <div class="custom-modal-body">

          <!-- loading -->
          <div v-if="loading" class="attachment-loading-container">
            <img v-bind:src="url+'attachment/img/loading.gif'" class="img-responsive" />
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
