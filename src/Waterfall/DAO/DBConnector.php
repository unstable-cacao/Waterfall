<?php
namespace Waterfall\DAO;


use Waterfall\Base\DAO\Connector\IDBConnector;

use Squid\MySql\IMySqlConnector;


/**
 * @unique
 */
class DBConnector implements IDBConnector
{
	public function get(): IMySqlConnector
	{
		return null;
	}
}