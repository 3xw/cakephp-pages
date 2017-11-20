<?php
namespace Trois\Pages\Controller\Admin;

use Trois\Pages\Controller\AppController;

/**
 * Sections Controller
 *
 * @property \Trois\Pages\Model\Table\SectionsTable $Sections
 *
 * @method \Trois\Pages\Model\Entity\Section[] paginate($object = null, array $settings = [])
 */
class SectionsController extends AppController
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
        $query = $this->Sections
        ->find('search',['search' => $this->request->query])
        ->contain(['SectionTypes', 'Pages']);
        $this->set('sections', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id Section id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $section = $this->Sections->get($id, [
            'contain' => ['SectionTypes', 'Pages', 'Articles']
        ]);

        $this->set('section', $section);
        $this->set('_serialize', ['section']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $section = $this->Sections->newEntity();
        if ($this->request->is('post')) {
            $section = $this->Sections->patchEntity($section, $this->request->getData());
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The section could not be saved. Please, try again.'));
        }
        $sectionTypes = $this->Sections->SectionTypes->find('list', ['limit' => 200]);
        $pages = $this->Sections->Pages->find('list', ['limit' => 200]);
        $this->set(compact('section', 'sectionTypes', 'pages'));
        $this->set('_serialize', ['section']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Section id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $section = $this->Sections->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $section = $this->Sections->patchEntity($section, $this->request->getData());
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The section could not be saved. Please, try again.'));
        }
        $sectionTypes = $this->Sections->SectionTypes->find('list', ['limit' => 200]);
        $pages = $this->Sections->Pages->find('list', ['limit' => 200]);
        $this->set(compact('section', 'sectionTypes', 'pages'));
        $this->set('_serialize', ['section']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Section id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $section = $this->Sections->get($id);
        if ($this->Sections->delete($section)) {
            $this->Flash->success(__('The section has been deleted.'));
        } else {
            $this->Flash->error(__('The section could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
