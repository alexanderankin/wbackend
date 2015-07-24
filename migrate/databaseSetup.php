<?php 
include 'rb.php';
R::setup('mysql:host=localhost; dbname=wbackend','root', 'toor');
/**
 * Do basic setup
 */
function basic ()
{
	/**
	* reorg code
	*/
	class tableCreator
	{
		public $tables;
		public $tableNames;
		public $ids;
		function __construct($tableNames = array('djs', 'programs'))
		{
			// dispense beans
			foreach ($tableNames as $value) {
				$this->tables["$value"] = R::dispense("$value");
			}
			
			// set some data
			$this->tables['djs']->name = 'First Dj';
			$this->tables['programs']->name = 'First Program';
			$this->store();
		}
		public function store() // storing ids essentially just in case
		{
			foreach ($this->tables as $key => $value) {
				$this->ids['bean - '.$key] = R::store($value);
			}
		}
	}
	$a = new tableCreator();	
}
function clean ()
{
	R::nuke();
}
/**
 * make control availible to robo
 */
switch (strtolower(end($argv))) {
	case 'basicsetup':
	case 'basic':
		basic();
		break;
	case 'clean':
		clean();
		break;
	
	default:
		# code...
		break;
}:
		clean();
		break;
	
	default:
		# code...
		break;
}