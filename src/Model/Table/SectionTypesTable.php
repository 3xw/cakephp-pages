<?php
namespace Trois\Pages\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
* SectionTypes Model
*
* @property \Trois\Pages\Model\Table\SectionsTable|\Cake\ORM\Association\HasMany $Sections
* @property \Trois\Pages\Model\Table\ArticleTypesTable|\Cake\ORM\Association\BelongsToMany $ArticleTypes
*
* @method \Trois\Pages\Model\Entity\SectionType get($primaryKey, $options = [])
* @method \Trois\Pages\Model\Entity\SectionType newEntity($data = null, array $options = [])
* @method \Trois\Pages\Model\Entity\SectionType[] newEntities(array $data, array $options = [])
* @method \Trois\Pages\Model\Entity\SectionType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
* @method \Trois\Pages\Model\Entity\SectionType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
* @method \Trois\Pages\Model\Entity\SectionType[] patchEntities($entities, array $data, array $options = [])
* @method \Trois\Pages\Model\Entity\SectionType findOrCreate($search, callable $callback = null, $options = [])
*/
class SectionTypesTable extends Table
{

  /**
  * Initialize method
  *
  * @param array $config The configuration for the Table.
  * @return void
  */
  public function initialize(array $config)
  {
    parent::initialize($config);

    $this->setTable('section_types');
    $this->setDisplayField('name');
    $this->setPrimaryKey('id');
    $this->addBehavior('Search.Search');
    $this->searchManager()
    ->add('q', 'Search.Like', [
      'before' => true,
      'after' => true,
      'mode' => 'or',
      'comparison' => 'LIKE',
      'wildcardAny' => '*',
      'wildcardOne' => '?',
      'field' => ['name']
    ]);


    $this->hasMany('Sections', [
      'foreignKey' => 'section_type_id',
      'className' => 'Trois/Pages.Sections',
      'dependent' => true,
      'cascadeCallbacks' => true,
    ]);
    $this->belongsToMany('ArticleTypes', [
      'foreignKey' => 'section_type_id',
      'targetForeignKey' => 'article_type_id',
      'joinTable' => 'section_types_article_types',
      'className' => 'Trois/Pages.ArticleTypes'
    ]);

    $this->addBehavior('Trois/Pages.Sluggable', ['field' => 'name','translate' => false]);

  }

  /**
  * Default validation rules.
  *
  * @param \Cake\Validation\Validator $validator Validator instance.
  * @return \Cake\Validation\Validator
  */
  public function validationDefault(Validator $validator)
  {
    $validator
    ->integer('id')
    ->allowEmpty('id', 'create');

    $validator
    ->scalar('name')
    ->requirePresence('name', 'create')
    ->notEmpty('name');

    return $validator;
  }
}
