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
        <?= __('Add Article') ?>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">description</i> '.__('Page'),['controller' => 'Pages','action'=>'manage', $section->page_id], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>


<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto">
    <div class="card">
      <?= $this->Form->create($article); ?>
      <div class="row">

        <!-- No i18n -->
        <?php if(empty($i18n)): ?>
          <div class="col-md-6">
            <?= $this->Form->input('title', ['class' => 'form-control']) ?>
            <?= $this->Form->input('meta', ['class' => 'form-control']) ?>
          </div>
          <div class="col-md-6">
            <?= $this->Form->input('header', ['class' => 'form-control']) ?>
          </div>
          <div class="col-md-12">
            <?= $this->Attachment->trumbowyg('body',[
               'types' =>['image/jpeg','image/png','image/gif'],
               'atags' => [],
               'restrictions' => [
                  Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED,
                  Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
               ],
               'content' => '',
            ]); ?>
          </div>
        <?php else: ?>
          <div class="col-12">
            <?= $this->element('locale',['fields' => [
              'title',
              'meta',
              'header',
              'body' => [
                'Attachment.trumbowyg' => [
                  'types' =>['image/jpeg','image/png'],
                  'atags' => [],
                    'restrictions' => [
                      Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED,
                      Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
                  ],
                  'content' => ''
                ]
              ]
            ]]) ?>
          </div>
        <?php endif;  ?>

        <!-- i18n -->
        <div class="col-md-6">
          <?= $this->Form->input('classes', ['class' => 'form-control']); ?>
          <?= $this->Form->input('article_type_id', ['options' => $articleTypes, 'class' => 'form-control']) ?>
          <?= $this->Form->input('order', ['value' => $section->count,'type' => 'hidden']) ?>
          <?= $this->Form->input('section_id', ['value' => $sectionId,'type' => 'hidden']) ?>
        </div>
        <div class="col-md-6">
          <?= $this->Attachment->input('Attachments', // if Attachments => HABTM else if !Attachments => belongsTo
          ['label' => __('Images'),
          'types' =>['image/jpeg','image/png', 'application/pdf', 'video/mp4'],
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
