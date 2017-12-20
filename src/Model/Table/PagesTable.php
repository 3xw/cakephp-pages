<?php
namespace Trois\Pages\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
 * Pages Model
 *
 * @property \Trois\Pages\Model\Table\PagesTable|\Cake\ORM\Association\BelongsTo $ParentPages
 * @property \Trois\Pages\Model\Table\PagesTable|\Cake\ORM\Association\HasMany $ChildPages
 * @property \Trois\Pages\Model\Table\SectionsTable|\Cake\ORM\Association\HasMany $Sections
 * @property \Trois\Pages\Model\Table\AttachmentsTable|\Cake\ORM\Association\BelongsToMany $Attachments
 *
 * @method \Trois\Pages\Model\Entity\Page get($primaryKey, $options = [])
 * @method \Trois\Pages\Model\Entity\Page newEntity($data = null, array $options = [])
 * @method \Trois\Pages\Model\Entity\Page[] newEntities(array $data, array $options = [])
 * @method \Trois\Pages\Model\Entity\Page|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Trois\Pages\Model\Entity\Page patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Trois\Pages\Model\Entity\Page[] patchEntities($entities, array $data, array $options = [])
 * @method \Trois\Pages\Model\Entity\Page findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class PagesTable extends Table
{
  use \Trois\Pages\Model\Traits\CustomTranslateTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pages');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');
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


        $this->belongsTo('ParentPages', [
            'className' => 'Trois/Pages.Pages',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildPages', [
            'className' => 'Trois/Pages.Pages',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Sections', [
            'foreignKey' => 'page_id',
            'className' => 'Trois/Pages.Sections'
        ]);
        $this->belongsToMany('Attachments', [
            'foreignKey' => 'page_id',
            'targetForeignKey' => 'attachment_id',
            'joinTable' => 'attachments_pages',
            'className' => 'Trois/Pages.Attachments'
        ]);

        // custom
        $i18n = Configure::read('I18n.languages');
        $translate = (empty($i18n))? false: true;
        $this->addBehavior('Trois/Pages.Sluggable', ['field' => 'title','translate' => $translate]);
        if($translate)
        {
          $this->addBehavior('Translate', ['fields' => ['title','slug','meta','header']]);
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
            ->scalar('page_type')
            ->requirePresence('page_type', 'create')
            ->notEmpty('page_type');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentPages'));

        return $rules;
    }
}
