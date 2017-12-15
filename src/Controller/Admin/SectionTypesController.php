<?php
namespace Trois\Pages\Controller\Admin;

use Trois\Pages\Controller\AppController;

class SectionTypesController extends AppController
{
  public $paginate = [
    'page' => 1,
    'limit' => 18,
    'maxLimit' => 200,
  ];

  use \Crud\Controller\ControllerTrait;

  public function initialize(){
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
