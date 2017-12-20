<?php
namespace Trois\Pages\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
* Article Entity
*
* @property int $id
* @property string $title
* @property string $slug
* @property string $meta
* @property string $header
* @property string $body
* @property string $classes
* @property int $order
* @property int $section_id
* @property int $article_type_id
*
* @property \Trois\Pages\Model\Entity\Section $section
* @property \Trois\Pages\Model\Entity\ArticleType $article_type
* @property \Trois\Pages\Model\Entity\Attachment[] $attachments
*/
class Article extends Entity
{

  use TranslateTrait;

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
