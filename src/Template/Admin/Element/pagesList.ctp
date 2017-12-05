<?
// js
$this->Html->scriptBlock("window.troisPagesList = ".json_encode($pages).";", ['block' => true]);
$this->Html->script([
  'Attachment.vendor/rubaxa/Sortable/Sortable.js',
  'Attachment.Element/Component/utils.js',
  'Trois/Pages.Element/Component/pagesListItem.js',
  'Trois/Pages.Element/Component/pagesList.js'
],['block' => true]);


// templates
$this->append('template', $this->element('Trois/Pages.Component/pagesListItem'));
$this->append('template', $this->element('Trois/Pages.Component/pagesList'));
?>
<trois-pages-list :url="'<?= $this->Url->build(['action' => 'orderChildren']) ?>'"></trois-pages-list>
