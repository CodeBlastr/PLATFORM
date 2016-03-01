<?php
/**
 * Lets put all the plugins we want to load in a single file, because it's changing often, and
 * someday I'll want to have a user interface for updating this file.
 *
 * @todo Create a user interface for updating this file (eg. installing plugins)
 */
use Cake\Core\Plugin;

Plugin::load('CodeBlastr/Users', ['routes' => true, 'bootstrap' => true]);
//Plugin::load('CodeBlastr/CakeDC/Users', ['routes' => true, 'bootstrap' => true]); // can we move this to CodeBlastr/Users delete...
Plugin::load('Crud');