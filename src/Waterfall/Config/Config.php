<?php
namespace Waterfall\Config;


use Objection\LiteObject;
use Objection\LiteSetup;


/**
 * @property DBConfig $DB
 */
class Config extends LiteObject
{

	/**
	 * @return array
	 */
	protected function _setup()
	{
		return [
			'DB'	=> LiteSetup::createInstanceOf(DBConfig::class)
		];
	}
	
	
	public function __construct()
	{
		parent::__construct();
		$this->DB = new DBConfig();
	}
	
	
	public function validate()
	{
		// TODO: Config validation goes here.
	}
}