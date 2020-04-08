<?php
namespace Trois\Pages\Model\Entity;

use Cake\ORM\Entity;

/**
 * Section Entity
 *
 * @property int $id
 * @property int $section_type_id
 * @property int $page_id
 * @property int $order
 *
 * @property \Trois\Pages\Model\Entity\SectionType $section_type
 * @property \Trois\Pages\Model\Entity\Page $page
 * @property \Trois\Pages\Model\Entity\Article[] $articles
 */
class Section extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
      '*' => true,
      'id' => false,
    ];
}
