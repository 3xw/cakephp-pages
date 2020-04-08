<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?= $this->Html->link('<i class="material-icons">add</i> '.__('Add'),['action'=>'add'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-semi"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
    <?= $this->Flash->render() ?>
    <?= $this->Flash->render('auth') ?>

    <!-- LIST ELEMENT -->
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">
          <?= __('Pages')?> <small>
        </h2>
      </div>
      <!-- START CONTEMT -->
      <div class="card-body">
        <?= $this->element('pagesList',['pages' => $pages]); ?>
      </div>
      <!-- END CONTEMT -->

    </div><!-- end content-->
  </div><!-- end card-->
</div><!-- end col-xs-12-->
