<?
$this->Html->css([
  'pages/main.min.css?v='.md5_file(APP.'../webroot/css/pages/main.min.css')
],['block' => 'css']);
// js
$this->Html->scriptBlock("window.troisPage = ".json_encode($page).";", ['block' => true]);
$this->Html->script([
  'pages/main.min.js?v='.md5_file(APP.'../webroot/js/pages/main.min.js'),
],['block' => true]);
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
<?= $this->Page->component('pages-page', ['url' => $this->Url->build('/', ['fullBase' => true])]);
