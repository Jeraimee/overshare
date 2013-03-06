<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

  public $components = array('Auth' => array('loginRedirect' => array('controller' => 'pages', 'action' => 'dashboard'),
                                             'logoutRedirect' => '/',
                                             'authError' => 'You must login to access that location.'),
                             'Cookie', 'DebugKit.Toolbar', 'Session');

  public function beforeFilter()
  {
    App::uses('Page', 'Model');
    $this->Page = ClassRegistry::init('Page');
    $this->Page->contain();
    $params = array('fields' => array('Page.slug', 'Page.title'));
    $this->set('pages', $this->Page->find('list', $params));

    if ($this->Auth->user()) {
      $this->set('user', $this->Auth->user());
    }
  }

}
