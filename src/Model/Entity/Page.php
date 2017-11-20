<?php
namespace Trois\Pages\Model\Entity;

use Cake\ORM\Entity;

/**
 * Page Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $meta
 * @property string $header
 * @property string $page_type
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 *
 * @property \Trois\Pages\Model\Entity\ParentPage $parent_page
 * @property \Trois\Pages\Model\Entity\ChildPage[] $child_pages
 * @property \Trois\Pages\Model\Entity\Section[] $sections
 * @property \Trois\Pages\Model\Entity\Attachment[] $attachments
 */
class Page extends Entity
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
        'title' => true,
        'slug' => true,
        'meta' => true,
        'header' => true,
        'page_type' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'parent_page' => true,
        'child_pages' => true,
        'sections' => true,
        'attachments' => true
    ];
}
