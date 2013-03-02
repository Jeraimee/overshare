<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Post extends AppModel {

  public $displayField = 'title';

  public $order = 'Post.created DESC';

  public $validate = array('title' => array('maxlen' => array('rule'       => array('maxLength', 255),
                                                              'message'    => 'Title was too long.',
                                                              'required'   => false,
                                                              'allowEmpty' => true)),
                           'body' => array('notempty' => array('rule'     => array('notempty'),
                                                               'message'  => 'Body is a required field.',
                                                               'required' => true)));

  public function beforeSave($options = array())
  {
   // Generate a slug for the post based on the title
   if (empty($this->data['Post']['slug'])) {
     $this->data['Post']['slug'] = strtolower(Inflector::slug($this->data['Post']['title']));
   }
   return true;
  }

}
