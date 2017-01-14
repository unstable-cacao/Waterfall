<?php
namespace Waterfall\Config;


use Objection\LiteSetup;
use Objection\LiteObject;


/**
 * @property DBConfig $DB
 * @property DefaultValues $Defaults
 */
class Config extends LiteObject
{
	/**
	 * @return array
	 */
	protected function _setup()
	{
		return [
			'DB'	    => LiteSetup::createInstanceOf(DBConfig::class),
			'Defaults'  => LiteSetup::createInstanceOf(DefaultValues::class)
		];
	}
	
	
	public function __construct()
	{
		parent::__construct();
		$this->DB = new DBConfig();
		$this->Defaults = new DefaultValues();
	}
	
	
	public function validate()
	{
		// TODO: Config validation goes here.
	}
}