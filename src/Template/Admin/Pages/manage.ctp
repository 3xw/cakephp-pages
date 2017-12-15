<?
// css
$this->Html->css([
  'Attachment.attachment.css',
],['block' => 'css']);

// js
$this->Html->scriptBlock("window.troisPage = ".json_encode($page).";", ['block' => true]);
$this->Html->script([
  'Attachment.vendor/rubaxa/Sortable/Sortable.js',
  'Attachment.Element/Component/utils.js',
  'Trois/Pages.Element/Component/page.js',
  'Trois/Pages.Element/Component/section-modal.js'
],['block' => true]);


// templates
$this->append('template', $this->element('Trois/Pages.Component/section-modal'));
$this->append('template', $this->element('Trois/Pages.Component/page'));
?>
<trois-pages-page :url="'<?= $this->Url->build('/') ?>'"></trois-pages-page>
