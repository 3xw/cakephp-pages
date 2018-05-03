<?
use Cake\I18n\I18n;
$this->setLayout('ajax');
$sectionType = $section->section_type->slug;

echo $this->element('Sections/section-'.$sectionType, ['section' => $section, 'lng' => I18n::getLocale(), 'key' => $key]);
?>

<!-- -->
<div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-secondary" onclick="window.mainEventHub.emit('page','section-add')" >Left</button>
  <button type="button" class="btn btn-secondary" onclick="window.mainEventHub.emit('page','section-add')">Middle</button>
  <button type="button" class="btn btn-secondary" onclick="window.mainEventHub.emit('page','section-add')">Right</button>
</div>
