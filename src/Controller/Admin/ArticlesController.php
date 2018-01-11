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
      $article->set('order', $section->count);
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

  public function edit($id = null)
  {
    $article = $this->Articles->find('translations')
    ->contain(['Sections','Attachments'])
    ->where(['Articles.id' => $id])
    ->first();

    if ($this->request->is(['patch', 'post', 'put'])) {
      $article = $this->Articles->patchEntity($article, $this->request->getData());
      if ($this->Articles->save($article)) {
        $this->Flash->success(__('The article has been saved.'));
        return $this->redirect(['controller' => 'Pages','action' => 'manage', $article->section->page_id]);
      }
      $this->Flash->error(__('The article could not be saved. Please, try again.'));
    }
    $sections = $this->Articles->Sections->find('list', ['limit' => 200]);
    $articleTypes = $this->Articles->ArticleTypes->find('list', ['limit' => 200]);
    $attachments = $this->Articles->Attachments->find('list', ['limit' => 200]);
    $this->set(compact('article', 'sections', 'articleTypes', 'attachments'));
    $this->set('_serialize', ['article']);
  }

  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $article = $this->Articles->find()
    ->contain(['Sections'])
    ->where(['Articles.id' => $id])
    ->first();

    if ($this->Articles->delete($article))
    {
      $articles = $this->Articles->find()->where(['section_id' => $article->section_id])->order(['order' => 'ASC'])->toArray();
      if(!empty($articles))
      {
        foreach($articles as $order => $whatever) $articles[$order]->set('order', $order);
        $this->Articles->saveMany($articles);
      }
      $this->Flash->success(__('The article has been deleted.'));
    } else
    {
      $this->Flash->error(__('The article could not be deleted. Please, try again.'));
    }
    return $this->redirect(['controller' => 'Pages','action' => 'manage', $article->section->page_id]);
  }
}
