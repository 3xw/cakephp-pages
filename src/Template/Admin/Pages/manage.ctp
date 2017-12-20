<?
// css
$this->Html->css([
  'Attachment.attachment.css',
  'Trois/Pages.admin/admin.min.css',
],['block' => 'css']);

// js
$this->Html->scriptBlock("window.troisPage = ".json_encode($page).";", ['block' => true]);
$this->Html->script([
  'Trois/Pages.vendor/rubaxa/Sortable/Sortable.js',
  'Attachment.Element/Component/utils.js',
  'Trois/Pages.Element/Component/page.js',
  'Trois/Pages.Element/Component/section-modal.js'
],['block' => true]);


// templates
$this->append('template', $this->element('Trois/Pages.Component/section-modal'));
$this->append('template', $this->element('Trois/Pages.Component/page'));
?>

<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= $page->title ?>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">list</i> '.__('Pages'),['action'=>'index'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>


<trois-pages-page :url="'<?= $this->Url->build('/') ?>'"></trois-pages-page>
