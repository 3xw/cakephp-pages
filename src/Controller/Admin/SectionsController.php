<?php
namespace Trois\Pages\Controller\Admin;

use Trois\Pages\Controller\AppController;

class SectionsController extends AppController
{
  public $paginate = [
    'page' => 1,
    'limit' => 18,
    'maxLimit' => 200,
  ];

  use \Crud\Controller\ControllerTrait;

  public function initialize() : void
  {
    parent::initialize();

    $this->loadComponent('Crud.Crud', [
      'actions' => [
        //'Crud.Index',
        'index' => [
          'className' => 'Crud.Index',
        ],
        'view' => [
          'className' => 'Crud.View',
        ],
        'add' =>[
          'className' => 'Crud.Add',
          'api.success.data.entity' => ['page_id','section_type'],
        ],
        'edit' => [
          'className' => 'Crud.Edit',
        ],
      ],
      'listeners' => [
        'Crud.Api',
        'Crud.ApiPagination',
        'Crud.ApiQueryLog',
        'Crud.Search',
      ]
    ]);

  }

  public function view($id = null, $key = 0)
  {
    $this->set('key', $key);
    $this->Crud->on('beforeFind', function (\Cake\Event\Event $event)
    {
      $event->getSubject()->query->contain(['SectionTypes','Articles' => ['ArticleTypes','Attachments' => ['sort' => ['AttachmentsArticles.order' => 'ASC']]]]);
    });

    return $this->Crud->execute();
  }

  public function add() {
    $this->Crud->on('beforeSave', function (\Cake\Event\Event $event)
    {
      if ($event->getSubject()->entity->isNew())
      {
        if (!$event->getSubject()->entity->has('order') )
        {
          $query = $this->Sections->find();
          $section = $query->select(['count' => $query->func()->count('id')])
          ->where(['Sections.page_id' => $event->getSubject()->entity->get('page_id')])
          ->first();
          $event->getSubject()->entity->set('order',$section->count);
        }
      }
    });

    return $this->Crud->execute();
  }

  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $section = $this->Sections->get($id);
    if ($this->Sections->delete($section))
    {
      $sections = $this->Sections->find()->where(['page_id' => $section->page_id])->order(['order' => 'ASC'])->toArray();
      if(!empty($sections))
      {
        foreach($sections as $order => $whatever) $sections[$order]->set('order', $order);
        $this->Sections->saveMany($sections);
      }
      $this->Flash->success(__('The section has been deleted.'));
    } else
    {
      $this->Flash->error(__('The section could not be deleted. Please, try again.'));
    }
    return $this->redirect(['controller' => 'Pages','action' => 'manage', $section->page_id]);
  }

}
