<?php
namespace Waterfall\Base\DAO\Connector;


use Squid\MySql\IMySqlConnector;


/**
 * @skeleton
 */
interface IDBConnector
{
	/** 
	 * @return IMySqlConnector
	 */
	public function get();
}