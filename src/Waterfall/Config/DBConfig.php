<?php
namespace Waterfall\Config;


use Objection\LiteSetup;
use Objection\LiteObject;

use Squid\MySql\Config\MySqlConnectionConfig;


/**
 * @property string $Host
 * @property string $Pass
 * @property string $User
 * @property string $DBName
 * @property string $TablePrefix
 */
class DBConfig extends LiteObject
{
	/**
	 * @return array
	 */
	protected function _setup()
	{
		return [
			'Host'			=> LiteSetup::createString('localhost'),
			'Pass'			=> LiteSetup::createString(''),
			'User'			=> LiteSetup::createString('root'),
			'DBName'		=> LiteSetup::createString('waterfall'),
			'TablePrefix'	=> LiteSetup::createString('')
		];
	}
	
	
	public function __debugInfo()
	{
		return [];
	}
	
	
	public function getConfig(): array
	{
		return $this->toArray(['Host', 'Pass', 'User', 'DBName']);
	}
	
	public function getTableName(string $name): string
	{
		return "{$this->TablePrefix}{$name}";
	}
}