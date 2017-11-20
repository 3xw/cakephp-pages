<?php
namespace Trois\Pages\Controller\Admin;

use Trois\Pages\Controller\AppController;

/**
 * ArticleTypes Controller
 *
 * @property \Trois\Pages\Model\Table\ArticleTypesTable $ArticleTypes
 *
 * @method \Trois\Pages\Model\Entity\ArticleType[] paginate($object = null, array $settings = [])
 */
class ArticleTypesController extends AppController
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
        $query = $this->ArticleTypes
        ->find('search',['search' => $this->request->query]);
        $this->set('articleTypes', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id Article Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $articleType = $this->ArticleTypes->get($id, [
            'contain' => ['SectionTypes', 'Articles']
        ]);

        $this->set('articleType', $articleType);
        $this->set('_serialize', ['articleType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $articleType = $this->ArticleTypes->newEntity();
        if ($this->request->is('post')) {
            $articleType = $this->ArticleTypes->patchEntity($articleType, $this->request->getData());
            if ($this->ArticleTypes->save($articleType)) {
                $this->Flash->success(__('The article type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article type could not be saved. Please, try again.'));
        }
        $sectionTypes = $this->ArticleTypes->SectionTypes->find('list', ['limit' => 200]);
        $this->set(compact('articleType', 'sectionTypes'));
        $this->set('_serialize', ['articleType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Article Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $articleType = $this->ArticleTypes->get($id, [
            'contain' => ['SectionTypes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articleType = $this->ArticleTypes->patchEntity($articleType, $this->request->getData());
            if ($this->ArticleTypes->save($articleType)) {
                $this->Flash->success(__('The article type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article type could not be saved. Please, try again.'));
        }
        $sectionTypes = $this->ArticleTypes->SectionTypes->find('list', ['limit' => 200]);
        $this->set(compact('articleType', 'sectionTypes'));
        $this->set('_serialize', ['articleType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $articleType = $this->ArticleTypes->get($id);
        if ($this->ArticleTypes->delete($articleType)) {
            $this->Flash->success(__('The article type has been deleted.'));
        } else {
            $this->Flash->error(__('The article type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
