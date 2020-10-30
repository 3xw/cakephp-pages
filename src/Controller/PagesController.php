<?php
namespace Trois\Pages\Controller;

use Trois\Pages\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\I18n\I18n;

class PagesController extends AppController
{
  public function initialize():void
  {
    parent::initialize();
    $this->Pages = $this->loadModel('Trois/Pages.Pages');
  }

  public function view($slug)
  {
    $lng = I18n::locale();
    $slugField = ($lng == 'fr_CH') ? 'Pages.slug' : 'Pages_slug_translation.content';

    $page = $this->Pages->find('translations')
    ->where([$slugField => $slug])
    ->contain([
      'Pages_slug_translation',
      'ParentPages',
      'ChildPages',
      'Attachments',
      'Sections' => [
        'SectionTypes',
        'Articles' => ['ArticleTypes', 'sort' => 'Articles.order', 'Attachments'],
        'sort' => 'Sections.order'
      ]
    ])
    ->first();

    $hasSubMenu = (!empty($page->parent_page) || !empty($page->child_pages))? true : false;

    $this->set('title', $page->title);
    $this->set('description', $page->meta);
    $this->set(compact('page', 'lng', 'hasSubMenu'));

  }

  public function display(...$path)
  {
    $count = count($path);
    if (!$count) {
      return $this->redirect('/');
    }
    if (in_array('..', $path, true) || in_array('.', $path, true)) {
      throw new ForbiddenException();
    }
    $page = $subpage = null;

    if (!empty($path[0])) {
      $page = $path[0];
    }
    if (!empty($path[1])) {
      $subpage = $path[1];
    }
    $this->set(compact('page', 'subpage'));

    try {
      $this->render(implode('/', $path));
    } catch (MissingTemplateException $exception) {
      if (Configure::read('debug')) {
        throw $exception;
      }
      throw new NotFoundException();
    }

    $hasSubMenu = false;
  }
}
