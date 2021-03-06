<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

        

	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
        Router::connect('/home', array('controller' => 'pages', 'action' => 'home'));

        Router::connect('/login', array('controller' => 'users', 'action' => 'login','admin'=>false));
        Router::connect('/admin/:controller/login', array('controller' => 'users', 'action' => 'login','admin'=>false));
        Router::connect('/admin', array('controller' => 'news', 'action' => 'index','admin'=>true));

        Router::connect('/kontakt', array('controller' => 'pages', 'action' => 'contact'));

        Router::connect('/nowosc/*', array('controller' => 'news', 'action' => 'single_news'));

        Router::connect('/poradniki/*', array('controller' => 'pages', 'action' => 'all_poradnik'));
        Router::connect('/poradnik/*', array('controller' => 'pages', 'action' => 'poradnik'));

        Router::connect('/championi/*', array('controller' => 'pages', 'action' => 'all_champions'));
        Router::connect('/champion/*', array('controller' => 'pages', 'action' => 'champion'));

        Router::connect('/rotacjaa', array('controller' => 'champions', 'action' => 'rotation'));
        Router::connect('/reset', array('controller' => 'users', 'action' => 'resetCache'));





/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
