<?
$this->Html->css([
  'Attachment.attachment.css',
  'Trois/Pages.admin/admin.min.css',
],['block' => 'css']);

// js
$this->Html->scriptBlock("window.troisPagesList = ".json_encode($pages).";", ['block' => true]);
$this->Html->script([
  'Trois/Pages.vendor/rubaxa/Sortable/Sortable.js',
  'Attachment.Element/Component/utils.js',
  'Trois/Pages.Element/Component/pagesListItem.js',
  'Trois/Pages.Element/Component/pagesList.js'
],['block' => true]);


// templates
$this->append('template', $this->element('Trois/Pages.Component/pagesListItem'));
$this->append('template', $this->element('Trois/Pages.Component/pagesList'));
?>
<trois-pages-list :url="'<?= $this->Url->build('/') ?>'"></trois-pages-list>
