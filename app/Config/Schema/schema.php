<?php 
App::uses('Post', 'Model');
class AppSchema extends CakeSchema {

  public function before($event = array())
  {
    return true;
  }

  public function after($event = array())
  {
    if (isset($event['create'])) {
      switch ($event['create']) {
        case 'posts':
        App::uses('ClassRegistry', 'Utility');
        $post = ClassRegistry::init('Post');
        $post->create();
        $post->save(array('Post' => array('title' => 'First Overshare!',
                                          'body'  => 'Welcome to <a href="https://github.com/Jeraimee/overshare">Overshare</a>!')));
        break;
      }
    }
  }

  public $posts = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
    'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
    'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
    'title' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'body' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );

}
