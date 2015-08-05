<?php 
include 'rb.php';
R::setup('mysql:host=localhost; dbname=wbackend','root', 'toor');
/**
 * Do basic setup
 */
function basic ()
{
	/**
	 * Re-organizing code
	 */
	class tableCreator
	{
		public $beanHolder;
		public $beanTypes;
		public $ids;
		// defaults from earlier commit
		/**
		 * 
		 * @param $number = number of beans of all beans (int) #DEPRECATED
		 * @param $beanCount = number of beans of each bean (array)
		 * TODO: make nB actually an associative array and not just a bunch of random numbers. FK
		 * 
		 */
		function __construct($beanTypes = array('schedule', 'programs', 'djs', 'playlists', 'songs'), 
			$beanCount = array('40', '108', '58', '2', '4'))
		{
			// dispense beans
			foreach ($beanTypes as $index => $bT) {
				for ($i = 0; $i < $beanCount[$index]; $i++) 
				{
					// the bH on this[subgrouped by type][and by index]
					$this->beanHolder["$bT"][] = R::dispense("$bT");
				}
			}
		}
		/**
		 * has schema specific code - do not abstract this. # lol past comments
		 * reminder of the syntax:
		 * 
		 * Table:
		 * +----+--------------+
		 * | id | field        |
		 * +----+--------------+
		 * |  1 | contents     | <-- Table_entry
		 * +----+--------------+
		 * 
		 * $Table_entry->field = 'contents'; echo R::store($Table_entry); // returns 1
		 * 
		 * List of variables erroneously named: wtf why are the sample entried called 
		 * tables -- just changed to beanHolder.
		 * 
		 * $beanHolder Schema:
		 * beanHolder[type][index]->field
		 * 
		 */
		public function lorem()
		{
			// Schedule: TODO fields
			//$this->beanHolder['schedule'][0]->

			// Programs:
			$this->beanHolder["programs"][0]->title = "Cornflower's Power Hour";
			$this->beanHolder["programs"][0]->genre = "AHHHH! AHHHHhHhHhHhHhHhHhHhHhhHHh!";
			/**
			 * for now is string, later is programmed relationship.
			 * can be null, model/frontend will know about 'unscheduled programs'
			 */
			foreach ($this->beanHolder['programs'] as $key => $value) {
				$value->times = null;
			}

			// DJs:
			$this->beanHolder['djs'][0]->name = 'Cornflower';

			// Song(s)?:
			$this->beanHolder['songs'][0]->title = 'The Piano Has Been Drinking';
			$this->beanHolder['songs'][0]->artist = 'Tom Waits';
			$this->beanHolder['songs'][0]->album = 'Small Change';

			$this->beanHolder['songs'][1]->title = 'Suppress the Electricity';
			$this->beanHolder['songs'][1]->artist = 'Nun';
			$this->beanHolder['songs'][1]->album =  null;

			$this->beanHolder['songs'][2]->title = 'First the Heart';
			$this->beanHolder['songs'][2]->artist = 'Flipper';
			$this->beanHolder['songs'][2]->album = null;

			$this->beanHolder['songs'][3]->title = 'Yea, Truth Faileth';
			$this->beanHolder['songs'][3]->artist = 'Dave Brubeck';
			$this->beanHolder['songs'][3]->album = 'Truth Is Fallen';

			// Playlists:
			$this->beanHolder['playlists'][0]->description = "Playlist 1";
			$this->beanHolder['playlists'][0]->sharedSongsList[] = $this->beanHolder['songs'][1];
			$this->beanHolder['playlists'][0]->sharedSongsList[] = $this->beanHolder['songs'][0];
			$this->beanHolder['playlists'][1]->description = "Playlist 2";
			$this->beanHolder['playlists'][1]->sharedSongsList[] = $this->beanHolder['songs'][2];
			$this->beanHolder['playlists'][1]->sharedSongsList[] = $this->beanHolder['songs'][3];
			$this->beanHolder['playlists'][1]->sharedSongsList[] = $this->beanHolder['songs'][0];
			//$this->beanHolder['playlists']-> // ownProgramList

			return $this;
		}
		public function store() // storing ids essentially just in case
		{
			foreach ($this->beanHolder as $key => $value) {
				foreach ($value as $key => $value) {
					$this->ids['bean - '.$key] = R::store($value);
				}
			}
			return $this;
		}
	}
	$a = (new tableCreator())
	->lorem()
	->store();	// see README
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
	case 'nuke':
		clean();
		break;
	
	default:
		# code...
		break;
}