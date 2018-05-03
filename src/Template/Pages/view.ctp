<div ref="page-<?= $page->id ?>">

  <? if($this->request->session()->read('Auth.User.id')): ?>

    <? // load stuff
    $this->append('template', $this->element('Trois/Pages.Component/page-section'));
    $this->append('template', $this->element('Trois/Pages.Component/page-sections-handler'));
    $this->Html->script([
      'Trois/Pages.Element/Component/utils.js',
      'Trois/Pages.Element/Component/page-section.js',
      'Trois/Pages.Element/Component/page-sections-handler.js',
    ],['block' => true]);
    ?>

    <!-- vuejs sections -->
    <? foreach($page->sections as $key => $section): ?>
      <page-section :id="<?= $section->id ?>" :i="<?= $key ?>"></page-section>
    <? endforeach ?>

    <!-- section handler HTML -->
    <page-sections-handler></page-sections-handler>

  <? else: ?>

  <!-- hard sections -->
  <? foreach($page->sections as $key => $section): ?>
    <? $sectionType = $section->section_type->slug ?>
    <?= $this->element('Sections/section-'.$sectionType, ['section' => $section, 'lng' => $lng, 'key' => $key]) ?>
  <? endforeach ?>

  <? endif; ?>

</div>
