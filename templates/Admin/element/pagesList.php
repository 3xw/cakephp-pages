<?php
$this->Html->css([
  'pages/main.min.css?v='.md5_file(APP.'../webroot/css/pages/main.min.css')
],['block' => 'css']);
// js
$this->Html->scriptBlock("window.troisPagesList = ".json_encode($pages).";", ['block' => true]);
$this->Html->script([
  'pages/main.min.js?v='.md5_file(APP.'../webroot/js/pages/main.min.js'),
],['block' => true]);

echo $this->Page->component('pages-list', ['url' => $this->Url->build('/')]);
?>
