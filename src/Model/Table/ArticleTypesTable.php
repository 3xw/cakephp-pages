<?php
namespace Trois\Pages\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArticleTypes Model
 *
 * @property \Trois\Pages\Model\Table\ArticlesTable|\Cake\ORM\Association\HasMany $Articles
 * @property \Trois\Pages\Model\Table\SectionTypesTable|\Cake\ORM\Association\BelongsToMany $SectionTypes
 *
 * @method \Trois\Pages\Model\Entity\ArticleType get($primaryKey, $options = [])
 * @method \Trois\Pages\Model\Entity\ArticleType newEntity($data = null, array $options = [])
 * @method \Trois\Pages\Model\Entity\ArticleType[] newEntities(array $data, array $options = [])
 * @method \Trois\Pages\Model\Entity\ArticleType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Trois\Pages\Model\Entity\ArticleType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Trois\Pages\Model\Entity\ArticleType[] patchEntities($entities, array $data, array $options = [])
 * @method \Trois\Pages\Model\Entity\ArticleType findOrCreate($search, callable $callback = null, $options = [])
 */
class ArticleTypesTable extends Table
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

        $this->setTable('article_types');
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


        $this->hasMany('Articles', [
            'foreignKey' => 'article_type_id',
            'className' => 'Trois/Pages.Articles'
        ]);
        $this->belongsToMany('SectionTypes', [
            'foreignKey' => 'article_type_id',
            'targetForeignKey' => 'section_type_id',
            'joinTable' => 'section_types_article_types',
            'className' => 'Trois/Pages.SectionTypes'
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
