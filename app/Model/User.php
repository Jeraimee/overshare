<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Page $Page
 * @property Post $Post
 */
class User extends AppModel {

  /**
   * Validation rules
   *
   * @var array
   */
  public $validate = array('username' => array('notempty' => array('rule'     => array('notempty'),
                                                                   'message'  => 'Username is a required field.',
                                                                   'required' => true)),
                           'password' => array('notempty' => array('rule'     => array('notempty'),
                                                                   'message'  => 'Password is a required field.',
                                                                   'required' => true)),
                           'name' => array('notempty' => array('rule'     => array('notempty'),
                                                               'message'  => 'Name is a required field.',
                                                               'required' => true)),
                           'email' => array('email' => array('rule' => array('email'),
                                                             'message' => 'Email is a required field.',
                                                             'required' => true)));

  /**
   * hasMany associations
   *
   * @var array
   */
  public $hasMany = array('Page', 'Post');

}
