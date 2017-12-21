<?php
namespace Trois\Pages\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
* Articles Model
*
* @property \Trois\Pages\Model\Table\SectionsTable|\Cake\ORM\Association\BelongsTo $Sections
* @property \Trois\Pages\Model\Table\ArticleTypesTable|\Cake\ORM\Association\BelongsTo $ArticleTypes
* @property \Trois\Pages\Model\Table\AttachmentsTable|\Cake\ORM\Association\BelongsToMany $Attachments
*
* @method \Trois\Pages\Model\Entity\Article get($primaryKey, $options = [])
* @method \Trois\Pages\Model\Entity\Article newEntity($data = null, array $options = [])
* @method \Trois\Pages\Model\Entity\Article[] newEntities(array $data, array $options = [])
* @method \Trois\Pages\Model\Entity\Article|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
* @method \Trois\Pages\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
* @method \Trois\Pages\Model\Entity\Article[] patchEntities($entities, array $data, array $options = [])
* @method \Trois\Pages\Model\Entity\Article findOrCreate($search, callable $callback = null, $options = [])
*/
class ArticlesTable extends Table
{

  use \Trois\Pages\Model\Traits\CustomTranslateTrait;

  //use \Cake\ORM\Behavior\Translate\TranslateTrait; // pire jaloux

  /**
  * Initialize method
  *
  * @param array $config The configuration for the Table.
  * @return void
  */
  public function initialize(array $config)
  {
    parent::initialize($config);

    $this->setTable('articles');
    $this->setDisplayField('title');
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
      'field' => ['title']
    ]);


    $this->belongsTo('Sections', [
      'foreignKey' => 'section_id',
      'joinType' => 'INNER',
      'className' => 'Trois/Pages.Sections'
    ]);
    $this->belongsTo('ArticleTypes', [
      'foreignKey' => 'article_type_id',
      'joinType' => 'INNER',
      'className' => 'Trois/Pages.ArticleTypes'
    ]);
    $this->belongsToMany('Attachments', [
      'foreignKey' => 'article_id',
      'targetForeignKey' => 'attachment_id',
      'joinTable' => 'attachments_articles',
      'className' => 'Trois/Pages.Attachments',
      'sort' => ['AttachmentsArticles.order' => 'ASC']
    ]);

    // custom
    $i18n = Configure::read('I18n.languages');
    $translate = (empty($i18n))? false: true;
    $this->addBehavior('Trois/Pages.Sluggable', ['field' => 'title','translate' => $translate]);
    if($translate)
    {
      $this->addBehavior('Translate', ['fields' => ['title','slug','meta','header','body']]);
    }
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
    ->scalar('title')
    ->requirePresence('title', 'create')
    ->notEmpty('title');

    $validator
    ->scalar('slug')
    ->requirePresence('slug', 'create')
    ->notEmpty('slug');

    $validator
    ->scalar('meta')
    ->allowEmpty('meta');

    $validator
    ->scalar('header')
    ->allowEmpty('header');

    $validator
    ->scalar('body')
    ->allowEmpty('body');

    $validator
    ->scalar('classes')
    ->allowEmpty('classes');

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
    $rules->add($rules->existsIn(['section_id'], 'Sections'));
    $rules->add($rules->existsIn(['article_type_id'], 'ArticleTypes'));

    return $rules;
  }
}
