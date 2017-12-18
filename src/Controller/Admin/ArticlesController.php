<?php
namespace Trois\Pages\Controller\Admin;

use Trois\Pages\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \Trois\Pages\Model\Table\ArticlesTable $Articles
 *
 * @method \Trois\Pages\Model\Entity\Article[] paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
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
        $query = $this->Articles
        ->find('search',['search' => $this->request->query])
        ->contain(['Sections', 'ArticleTypes']);
        $this->set('articles', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Sections', 'ArticleTypes', 'Attachments']
        ]);

        $this->set('article', $article);
        $this->set('_serialize', ['article']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($sectionId)
    {
        $article = $this->Articles->newEntity();
        $query = $this->Articles->Sections->find();
        $section = $query->select(['page_id','count' => $query->func()->count('Articles.id')])
        ->matching('Articles')
        ->where(['Sections.id' => $sectionId])
        ->first();
        
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['controller' => 'Pages','action' => 'manage', $section->page_id]);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $articleTypes = $this->Articles->ArticleTypes->find('list', ['limit' => 200]);

        $this->set(compact('sectionId','section','article', 'articleTypes'));
        $this->set('_serialize', ['article']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Attachments']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $sections = $this->Articles->Sections->find('list', ['limit' => 200]);
        $articleTypes = $this->Articles->ArticleTypes->find('list', ['limit' => 200]);
        $attachments = $this->Articles->Attachments->find('list', ['limit' => 200]);
        $this->set(compact('article', 'sections', 'articleTypes', 'attachments'));
        $this->set('_serialize', ['article']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
