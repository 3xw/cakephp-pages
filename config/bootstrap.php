<?php
use Cake\Core\Configure;

if(Configure::read('Trois/Pages')) return;
Configure::load('Trois/Pages.pages');
