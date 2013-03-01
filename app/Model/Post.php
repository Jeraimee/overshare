<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Post extends AppModel {

/**
 * Display field
 *
 * @var string
 */
  public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
  public $validate = array('title' => array('maxlen' => array('rule'       => array('maxLength', 255),
                                                              'message'    => 'Title was too long.',
                                                              'required'   => false,
                                                              'allowEmpty' => true)),
                           'body' => array('notempty' => array('rule'     => array('notempty'),
                                                               'message'  => 'Body is a required field.',
                                                               'required' => true)));

}
