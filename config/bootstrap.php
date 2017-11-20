<?php
use Cake\Core\Configure;

Configure::load('Trois/Pages.pages');

collection((array)Configure::read('Trois/Pages.config'))->each(function ($file) {
    Configure::load($file,'default',true);
});
//debug(Configure::read('Trois/Pages'));
