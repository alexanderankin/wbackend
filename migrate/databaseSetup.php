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
	class ClassName
	{
		public OODBBean $djbean; //  might need a /** @var OODBBean*/
		public OODBBean $program;
		public $ids;
		function __construct(argument)
		{
			$this->$djbean = R::dispense('dj');
			$this->$djbean->name = "First Dj";
			$this->$program = R::dispense('program');
		}
		public function store($value='')
		{
			$this->$ids['dj - '.$djbean->name] = R::store($this->$djbean);
			$this->$ids['pr - '.$program->name] = R::store($this->$program);
		}
	}
	// make a dj
	// $djbean = R::dispense('dj');
	// $djbean->name = "First Dj";
	// $firstdjbeanid = R::store($djbean);
	// echo "\n\n\tThe created djbean has id $firstdjbeanid.\n\n";
	$a = new ClassName();
	$a->store;
}
function clean()
{
	R::nuke();
}
/**
 * make control availible to robo
 */
switch (strtolower(end($argv))) {
	case 'basicsetup':
		basic();
		break;
	case 'clean':
		clean();
		break;
	
	default:
		# code...
		break;
}