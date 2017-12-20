<?php
namespace Trois\Pages\Controller\Admin;

use Trois\Pages\Controller\AppController;

/**
* Pages Controller
*
* @property \Trois\Pages\Model\Table\PagesTable $Pages
*
* @method \Trois\Pages\Model\Entity\Page[] paginate($object = null, array $settings = [])
*/
class PagesController extends AppController
{
  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('Search.Prg', [
      'actions' => ['index']
    ]);
  }

  /**
  * Index method
  *
  * @return \Cake\Http\Response|void
  */
  public function index()
  {
    $this->set(
      'pages',
      $this->Pages->find()
      ->order([
        'lft' => 'ASC'
      ])
      ->toArray()
    );
  }

  public function orderChildren($id)
  {
    if ($this->request->is('post'))
    {
      $page = $this->Pages->find()->where(['id' => $id])->first();
      $gap = (int) $this->request->data['to'] - (int) $this->request->data['from'];
      if($gap > 0){
        $this->Pages->moveDown($page, abs($gap));
      }else{
        $this->Pages->moveUp($page, abs($gap));
      }
    }
  }

  public function manage($id = null)
  {
    $page = $this->Pages->get($id, [
      'contain' => [
        'Attachments',
        'Sections' => [
          'SectionTypes',
          'Articles' => ['ArticleTypes', 'sort' => 'Articles.order'],
          'sort' => 'Sections.order'
        ]
      ]
    ]);

    /*
    if ($this->request->is(['patch', 'post', 'put'])) {
      $page = $this->Pages->patchEntity($page, $this->request->getData());
      if ($this->Pages->save($page)) {
        $this->Flash->success(__('The page has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The page could not be saved. Please, try again.'));
    }
    $parentPages = $this->Pages->ParentPages->find('list', ['limit' => 200]);
    $attachments = $this->Pages->Attachments->find('list', ['limit' => 200]);
    */
    $this->set(compact('page'));
    $this->set('_serialize', ['page']);
  }


  /**
  * View method
  *
  * @param string|null $id Page id.
  * @return \Cake\Http\Response|void
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function view($id = null)
  {
    $page = $this->Pages->get($id, [
      'contain' => ['ParentPages', 'Attachments', 'ChildPages', 'Sections']
    ]);

    $this->set('page', $page);
    $this->set('_serialize', ['page']);
  }

  /**
  * Add method
  *
  * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
  */
  public function add()
  {
    $page = $this->Pages->newEntity();
    if ($this->request->is('post')) {
      $page = $this->Pages->patchEntity($page, $this->request->getData());
      if ($this->Pages->save($page)) {
        $this->Flash->success(__('The page has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The page could not be saved. Please, try again.'));
    }
    $parentPages = $this->Pages->ParentPages->find('list', ['limit' => 200]);
    $attachments = $this->Pages->Attachments->find('list', ['limit' => 200]);
    $this->set(compact('page', 'parentPages', 'attachments'));
    $this->set('_serialize', ['page']);
  }

  /**
  * Edit method
  *
  * @param string|null $id Page id.
  * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
  * @throws \Cake\Network\Exception\NotFoundException When record not found.
  */
  public function edit($id = null)
  {
    $page = $this->Pages->get($id, [
      'contain' => ['Attachments']
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $page = $this->Pages->patchEntity($page, $this->request->getData());
      if ($this->Pages->save($page)) {
        $this->Flash->success(__('The page has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The page could not be saved. Please, try again.'));
    }
    $parentPages = $this->Pages->ParentPages->find('list', ['limit' => 200]);
    $attachments = $this->Pages->Attachments->find('list', ['limit' => 200]);
    $this->set(compact('page', 'parentPages', 'attachments'));
    $this->set('_serialize', ['page']);
  }

  /**
  * Delete method
  *
  * @param string|null $id Page id.
  * @return \Cake\Http\Response|null Redirects to index.
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $page = $this->Pages->get($id);
    if ($this->Pages->delete($page)) {
      $this->Flash->success(__('The page has been deleted.'));
    } else {
      $this->Flash->error(__('The page could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
