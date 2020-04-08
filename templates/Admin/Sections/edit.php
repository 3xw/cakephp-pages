<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Edit Section') ?>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
          <?= $this->Html->link('<i class="material-icons">list</i> '.__('List'),['action'=>'index'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto">
    <div class="card">
      <?= $this->Form->create($section); ?>
      <?php
                  echo $this->Form->control('section_type_id', ['options' => $sectionTypes, 'class' => 'form-control']);
                        echo $this->Form->control('page_id', ['options' => $pages, 'class' => 'form-control']);
                        echo $this->Form->control('order', ['class' => 'form-control']);
                ?>
    <div class="text-right">
      <div class="btn-group">
        <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-danger btn-fill']) ?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-info btn-fill']) ?>
      </div>
    </div>
    <?= $this->Form->end() ?>
  </div>
</div>
</div>
<div class="utils--spacer-default"></div>