<?php
App::uses('Shell', 'Console');

/**
 * Email Shell
 *
 */
class EmailShell extends Shell {

  public $tasks = array('Get');

  public function main()
  {
    $this->out('Overshare email command shell.');
    $this->out('Use this shell to send and retrieve email.');
    $this->out('Commands available: get');
    $this->hr();
  }

}
