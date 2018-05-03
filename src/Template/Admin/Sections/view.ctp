<?
use Cake\I18n\I18n;
$this->setLayout('ajax');
$sectionType = $section->section_type->slug;
?>

<?= $this->element('Sections/section-'.$sectionType, ['section' => $section, 'lng' => I18n::getLocale(), 'key' => $key]) ?>

<!-- section edit buttons-->
<?= $this->element('Trois/Pages.Tools/section-edit',['id' => $section->id]) ?>
