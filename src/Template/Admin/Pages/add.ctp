<?php
use Cake\Core\Configure;
$i18n = Configure::read('I18n.languages');
// css
$this->Html->css([
  'Attachment.attachment.css',
  'Trois/Pages.admin/admin.min.css',
],['block' => 'css']);
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
        <div class="col-md-12">
          <?php
          if($i18n)
          {
            echo $this->element('locale',['fields' => ['title','meta','header' => [
              'Trois/Tinymce.tinymce' => [
                'value' => '',
                'init' => []
              ]
            ],

            ]]);
          }else{
            echo $this->Form->input('title', ['class' => 'form-control']);
            echo $this->Form->input('meta', ['type' => 'textarea','class' => 'form-control no-trumbowyg']);
            echo $this->element('Trois/Tinymce.tinymce',[
              'field' => 'header',
              'value' => '',
              'init' => []
            ]);

          }

          if(count(Configure::read('Trois/Pages.pageTypes')) > 1)
          {
            echo $this->Form->input('page_type',['options' => Configure::read('Trois/Pages.pageTypes'), 'class' => 'form-control']);
          }else{
            echo $this->Form->input('page_type', ['type' => 'hidden', 'value' => 'default']);
          }
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
