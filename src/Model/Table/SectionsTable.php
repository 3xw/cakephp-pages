<?php
namespace Trois\Pages\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
* Sections Model
*
* @property \Trois\Pages\Model\Table\SectionTypesTable|\Cake\ORM\Association\BelongsTo $SectionTypes
* @property \Trois\Pages\Model\Table\PagesTable|\Cake\ORM\Association\BelongsTo $Pages
* @property \Trois\Pages\Model\Table\ArticlesTable|\Cake\ORM\Association\HasMany $Articles
*
* @method \Trois\Pages\Model\Entity\Section get($primaryKey, $options = [])
* @method \Trois\Pages\Model\Entity\Section newEntity($data = null, array $options = [])
* @method \Trois\Pages\Model\Entity\Section[] newEntities(array $data, array $options = [])
* @method \Trois\Pages\Model\Entity\Section|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
* @method \Trois\Pages\Model\Entity\Section patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
* @method \Trois\Pages\Model\Entity\Section[] patchEntities($entities, array $data, array $options = [])
* @method \Trois\Pages\Model\Entity\Section findOrCreate($search, callable $callback = null, $options = [])
*/
class SectionsTable extends Table
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

    $this->setTable('sections');
    $this->setDisplayField('id');
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
      'field' => ['id']
    ]);


    $this->belongsTo('SectionTypes', [
      'foreignKey' => 'section_type_id',
      'joinType' => 'INNER',
      'className' => 'Trois/Pages.SectionTypes'
    ]);
    $this->belongsTo('Pages', [
      'foreignKey' => 'page_id',
      'joinType' => 'INNER',
      'className' => 'Trois/Pages.Pages'
    ]);
    $this->hasMany('Articles', [
      'foreignKey' => 'section_id',
      'className' => 'Trois/Pages.Articles',
      'dependent' => true,
      'cascadeCallbacks' => true,
    ]);
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
    ->integer('order')
    ->allowEmpty('order');

    return $validator;
  }

  /**
  * Returns a rules checker object that will be used for validating
  * application integrity.
  *
  * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
  * @return \Cake\ORM\RulesChecker
  */
  public function buildRules(RulesChecker $rules)
  {
    $rules->add($rules->existsIn(['section_type_id'], 'SectionTypes'));
    $rules->add($rules->existsIn(['page_id'], 'Pages'));

    return $rules;
  }
}
