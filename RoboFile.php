<?php 
/**
* robo task runner definitions
*/
class RoboFile extends \Robo\Tasks
{
	public function migrate ($level) {
		$this->taskExec("php migrate/databaseSetup.php $level")->run();
	}
}