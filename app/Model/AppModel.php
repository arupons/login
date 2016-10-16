<?php

App::uses('Model', 'Model');

/**
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	var $specific = false; 

    //Retornar ultima query ejecutada
  public function lastQuery(){
    $dbo = $this->getDatasource();
    $logs = $dbo->getLog(false,false);
    var_dump($logs);
    debug($logs);
    return $logs['log']['query'];
  }
  // Function based on http://stackoverflow.com/questions/13223946/how-to-use-multiple-databases-dynamically-for-one-model-in-cakephp
  //Useful to select database dinamically, So each customer can have their own db.
}
