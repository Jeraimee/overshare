<?php
App::uses('AppModel', 'Model');
/**
 * Page Model
 *
 */
class Page extends AppModel {

  /**
   * Display field
   *
   * @var string
   */
  public $displayField = 'title';

  public $order = 'Page.title';

  /**
   * Validation rules
   *
   * @var array
   */
  public $validate = array('title' => array('notempty' => array('rule'     => array('notempty'),
                                                                'message'  => 'Title is a required field.',
                                                                'required' => true)),
                           'body' => array('notempty' => array('rule'     => array('notempty'),
                                                               'message'  => 'Body is a required field.',
                                                               'required' => true)));

  /**
  * belongsTo associations
  *
  * @var array
  */
  public $belongsTo = array('User');


  public function beforeSave($options = array())
  {
    // Generate a unique slug for the page based on the title
    if (empty($this->data['Page']['slug'])) {
      $slug = strtolower(Inflector::slug($this->data['Page']['title']));
      if (isset($options['addrand'])) {
        $slug = $slug . '-' . rand(100, 1000);
      }
      if ($this->isUniqueSlug($slug)) {
        $this->data['Page']['slug'] = $slug;
        return true;
      }
      else {
        $this->beforeSave(array('addrand' => true));
      }
    }
  }


  /**
   * Returns true if the given slug is unique in the table
   *
   * @param string $slug
   * @return bool
   */

  private function isUniqueSlug($slug = '')
  {
    if (empty($slug)) {
      return false;
    }
    return (bool) !$this->find('count', array('conditions' => array('Page.slug' => $slug)));
  }

}
