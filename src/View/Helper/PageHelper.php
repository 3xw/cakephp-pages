<?php
namespace Trois\Pages\View\Helper;
use Cake\View\Helper;
use Cake\View\View;
use Cake\Core\Configure;
use Cake\Routing\Router;
class PageHelper extends Helper
{

  public $helpers = ['Url','Html'];

  public function component($name, $props = [])
  {
    return $this->_View->Html->tag('page-loader', '', ['name' => $name, 'props' => json_encode($props)]);
  }

}
