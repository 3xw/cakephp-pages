<?php
use Cake\Core\Configure;
$i18n = Configure::read('I18n.languages');
?>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?php // $this->Html->link('<i class="material-icons">list</i> '.__('List'),['action'=>'index'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-semi"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto">
    <div class="card">
      <?= $this->Form->create($article); ?>
      <div class="card-header">
        <h2><?= __('Add Article') ?></h2>
      </div>
      <div class="card-body">
        <div class="row">
          <!-- No i18n -->
          <?php if(empty($i18n)): ?>
            <div class="col-md-6">
              <?= $this->Form->control('title', ['class' => 'form-control']) ?>
              <?= $this->Form->control('meta', ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-6">
              <?= $this->element('Trois/Tinymce.tinymce',[
                  'field' => 'header',
                  'value' => '',
                  'init' => []
                ]);
              ?>
            </div>
            <div class="col-md-12">
              <?= $this->element('Trois/Tinymce.tinymce',[
                'field' => 'body',
                'value' => '',
                'init' => [
                  'external_plugins' => [
                    'attachment' => $this->Url->build('/attachment/js/Plugins/tinymce/plugin.min.js', ['fullBase' => true]),
                  ],
                  'attachment_settings' => $this->Attachment->setup('body',[
                    'types' => [
                      'application/pdf',
                      'application/msword',
                      'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                      'application/vnd.ms-excel',
                      'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                      'image/jpeg',
                      'image/png',
                      'image/gif',
                      'embed/youtube',
                      'embed/vimeo'
                    ],
                    'atags' => [],
                    'restrictions' => [
                      Trois\Attachment\View\Helper\AttachmentHelper::TAG_OR_RESTRICTED,
                      Trois\Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
                    ],
                  ])
                ]
              ]); ?>
            </div>
          <?php else: ?>
            <div class="col-12">
              <?= $this->element('locale',['fields' => [
                'title',
                'meta',
                'header' => [
                  'Trois/Tinymce.tinymce' => [
                    'value' => '',
                    'init' => []
                  ]
                ],
                'body' => [
                  'Trois/Tinymce.tinymce' => [
                    'value' => '',
                    'init' => [
                      'external_plugins' => [
                        'attachment' => $this->Url->build('/attachment/js/Plugins/tinymce/plugin.min.js', ['fullBase' => true]),
                      ],
                      'attachment_settings' => [
                        'types' => [
                          'application/pdf',
                          'application/msword',
                          'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                          'application/vnd.ms-excel',
                          'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                          'image/jpeg',
                          'image/png',
                          'embed/youtube',
                          'embed/vimeo'
                        ],
                        'atags' => [],
                        'restrictions' => [
                          Trois\Attachment\View\Helper\AttachmentHelper::TAG_OR_RESTRICTED,
                          Trois\Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
                        ]
                      ]
                    ]
                  ]
                ]
              ]]) ?>
            </div>
          <?php endif;  ?>

          <!-- i18n -->
          <div class="col-md-6">
            <?= $this->Form->control('classes', ['class' => 'form-control']); ?>
            <?= $this->Form->control('article_type_id', ['options' => $articleTypes, 'class' => 'form-control']) ?>
            <?= $this->Form->control('order', ['value' => $section->count,'type' => 'hidden']) ?>
            <?= $this->Form->control('section_id', ['value' => $sectionId,'type' => 'hidden']) ?>
          </div>
          <div class="col-md-6">
            <?= $this->Attachment->input('Attachments', // if Attachments => HABTM else if !Attachments => belongsTo
            ['label' => __('Images'),
            'types' =>['image/jpeg','image/png', 'application/pdf', 'video/mp4'],
            'atags' => [],
              'restrictions' => [
                Trois\Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED,
                Trois\Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
              ],
              'attachments' => [] // array of exisiting Attachment entities ( HABTM ) or entity ( belongsTo )
            ]);
            ?>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
          <div class="btn-group">
            <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-danger btn-fill']) ?>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-info btn-fill']) ?>
          </div>
        </div>
      </div>
    <?= $this->Form->end() ?>
  </div>
</div>
</div>
<div class="utils--spacer-default"></div>
