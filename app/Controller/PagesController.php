<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

  /**
   * Controller name
   *
   * @var string
   */
  public $name = 'Pages';

  /**
   * Custom home view
   */
  public function home()
  {
    App::uses('Post', 'Model');
    $this->Post = ClassRegistry::init('Post');
    $params = array('limit' => 10);
    $this->set('posts', $this->Post->find('all', $params));
  }

  /**
   * Displays a view
   *
   * @param mixed What page to display
   * @return void
   */
  public function display($slug = null)
  {
    if (empty($slug)) {
      $this->redirect('/');
    }

    $params = array('conditions' => array('Page.slug' => $slug));

    $page = $this->Page->find('first', $params);
    if (empty($page)) {
      throw new NotFoundException(__('Invalid page'));
    }
    $this->set('page', $page);
  }


  /**
   * add method
   *
   * @return void
   */

  public function admin_add()
  {
    if ($this->request->is('post')) {
      $this->Page->create();
      if ($this->Page->save($this->request->data)) {
        $this->Session->setFlash(__('The page has been saved'));
        $this->redirect("/{$this->data['Page']['slug']}");
      }
      else {
        $this->Session->setFlash(__('The page could not be saved. Please, try again.'));
      }
    }
  }


  /**
   * admin_edit method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */

  public function admin_edit($id = null)
  {
    $this->Page->id = $id;
    if (!$this->Page->exists()) {
      throw new NotFoundException(__('Invalid page'));
    }
    if ($this->request->is('post') || $this->request->is('put')) {
      if ($this->Page->save($this->request->data)) {
        $this->Session->setFlash(__('The page has been saved'));
        $this->redirect("/{$this->data['Page']['slug']}");
      }
      else {
        $this->Session->setFlash(__('The page could not be saved. Please, try again.'));
      }
    }
    else {
      $this->request->data = $this->Page->read(null, $id);
    }
  }


  /**
   * admin_delete method
   *
   * @throws MethodNotAllowedException
   * @throws NotFoundException
   * @param string $id
   * @return void
   */

  public function admin_delete($id = null)
  {
    if (!$this->request->is('post')) {
      throw new MethodNotAllowedException();
    }
    $this->Page->id = $id;
    if (!$this->Page->exists()) {
      throw new NotFoundException(__('Invalid post'));
    }
    if ($this->Page->delete()) {
      $this->Session->setFlash(__('Page deleted'));
      $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__('Page was not deleted'));
    $this->redirect(array('action' => 'index'));
  }

}
