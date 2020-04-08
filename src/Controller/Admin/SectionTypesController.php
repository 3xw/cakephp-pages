<?php
namespace Trois\Pages\Controller\Admin;

use Trois\Pages\Controller\AppController;
use Cake\Event\Event;
use Crud\Event\Subject;
use Cake\Core\Configure;
use Cake\Http\Exception\UnauthorizedException;

class SectionTypesController extends AppController
{
  public $paginate = [
    'page' => 1,
    'limit' => 18,
    'maxLimit' => 200,
  ];

  use \Crud\Controller\ControllerTrait;

  public function initialize(): void
  {
    parent::initialize();

    $this->loadComponent('Crud.Crud', [
      'actions' => [
        //'Crud.Index',
        'index' => [
          'className' => 'Crud.Index',
          'relatedModels' => ['SectionTypes','Articles' => ['ArticlesTypes']]
        ],
        'view' => [
          'className' => 'Crud.View',
          'relatedModels' => ['SectionTypes','Articles' => ['ArticlesTypes']]
        ],
        'add' =>[
          'className' => 'Crud.Add',
          'api.success.data.entity' => ['id','name','slug'],
          'api.error.exception' => [
            'type' => 'validate',
            'class' => 'Attachment\Crud\Error\Exception\ValidationException'
          ],
        ],
        'edit' => [
          'className' => 'Crud.Edit',
        ],
        'delete' => [
          'className' => 'Crud.Delete',
        ],
      ],
      'listeners' => [
        'Crud.Api',
        'Crud.ApiPagination',
        'Crud.ApiQueryLog',
        'Crud.Search'
      ]
    ]);

  }
}
