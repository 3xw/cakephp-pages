<?
$this->Html->css([
  'plugins/pages/pages.min.css?v='.md5_file(APP.'../webroot/css/plugins/pages/pages.min.css')
],['block' => 'css']);
// js
$this->Html->scriptBlock("window.troisPagesList = ".json_encode($pages).";", ['block' => true]);
$this->Html->script([
  'plugins/pages/pages.vendor.min.js?v='.md5_file(APP.'../webroot/js/plugins/pages/pages.vendor.min.js'),
  'plugins/pages/pages.min.js?v='.md5_file(APP.'../webroot/js/plugins/pages/pages.min.js'),
],['block' => true]);

echo $this->Page->component('pages-list', ['url' => $this->Url->build('/')]);
?>
