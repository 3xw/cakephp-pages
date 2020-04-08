<?
use Cake\Core\Configure;
?>
<div ref="page-<?= $page->id ?>">

  <? if($this->request->session()->read('Auth.User.id')): ?>

    <!-- FRONT EDIT FUTUR -->
    <? /*
    $this->append('template', $this->element('Trois/Pages.Component/page-input'));
    $this->append('template', $this->element('Trois/Pages.Component/page-section'));
    $this->append('template', $this->element('Trois/Pages.Component/page-sections-handler'));
    $this->append('template', $this->element('Trois/Pages.Component/page-articles-handler'));
    $this->Html->css([
      'Trois/Pages.front/front.min.css',
    ],['block' => 'css']);
    $this->Html->script([
      'Trois/Pages.Element/Component/utils.js',
      'Trois/Pages.Element/Component/page-input.js',
      'Trois/Pages.Element/Component/page-section.js',
      'Trois/Pages.Element/Component/page-sections-handler.js',
      'Trois/Pages.Element/Component/page-articles-handler.js',
    ],['block' => true]);
    */
    ?>

    <!-- vuejs sections -->
    <? foreach($page->sections as $key => $section): ?>
      <!--<page-section :ref="'section-'+<?= $section->id ?>" :id="<?= $section->id ?>" :i="<?= $key ?>"></page-section>-->
    <? endforeach ?>

    <!-- section handler HTML -->
    <!-- <page-sections-handler></page-sections-handler>-->

    <!-- section handler HTML -->
    <!-- <page-articles-handler :languages="<?= htmlspecialchars(json_encode(Configure::read('I18n.languages')), ENT_QUOTES, 'UTF-8') ?>" :default-locale="'<?= Configure::read('App.defaultLocale') ?>'"></page-articles-handler>-->


  <? else: ?>

  <!-- hard sections -->
  <? foreach($page->sections as $key => $section): ?>
    <? $sectionType = $section->section_type->slug ?>
    <?= $this->element('Sections/section-'.$sectionType, ['section' => $section, 'lng' => $lng, 'key' => $key]) ?>
  <? endforeach ?>

  <? endif; ?>

</div>
