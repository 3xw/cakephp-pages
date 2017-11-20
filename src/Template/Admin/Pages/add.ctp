<?php
use Cake\Core\Configure;
?>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Add Page') ?>
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
      <?= $this->Form->create($page); ?>
      <div class="row">
        <div class="col-md-6">
          <?php
          if(Configure::read('Trois/Pages.translate'))
          {
            echo $this->element('locale',['fields' => ['title','slug','meta','header']]);
          }else{
            echo $this->Form->input('title', ['class' => 'form-control']);
            echo $this->Form->input('slug', ['class' => 'form-control']);
            echo $this->Form->input('meta', ['type' => 'textarea','class' => 'form-control no-trumbowyg']);
            echo $this->Form->input('header', ['class' => 'form-control']);
          }
        ?>
        </div>
        <div class="col-md-6">
          <?php
          echo $this->Form->input('page_type', ['class' => 'form-control']);
          echo $this->Form->input('parent_id', ['options' => $parentPages, 'empty' => true, 'class' => 'form-control']);
          echo $this->Attachment->input('Attachments', // if Attachments => HABTM else if !Attachments => belongsTo
            ['label' => __('Images'),
            'types' =>['image/jpeg','image/png'],
            'atags' => [],
            'restrictions' => [
              Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED,
              Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
            ],
            'attachments' => [] // array of exisiting Attachment entities ( HABTM ) or entity ( belongsTo )
          ]);
          ?>
        </div>
      </div>

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
