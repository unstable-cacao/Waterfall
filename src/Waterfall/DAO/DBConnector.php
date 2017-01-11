<?php
namespace Waterfall\DAO;


use Waterfall\Base\DAO\Connector\IDBConnector;
use Waterfall\Config\Config;
use Waterfall\Exceptions\WaterfallDataBaseException;

use Squid\MySql;
use Squid\MySql\IMySqlConnector;
use Squid\MySql\Impl\Connection\Executors\SilentErrorDecorator;


/**
 * @unique
 * @autoload
 */
class DBConnector implements IDBConnector
{
	/** @var \Squid\MySql */
	private $mysql;
	
	
	private function handleError(string $cmd, array $bind = [], \Exception $e)
	{
		throw new WaterfallDataBaseException('Error thrown in waterfall when accessing DB', 0, $e);
	}
	
	
	public function __construct(Config $config)
	{
		$this->mysql = new MySql();
		$this->mysql->config()
			->addConfig('main', $config->DB->getConfig())
			->addExecuteDecorator(
				(new SilentErrorDecorator())->setCallback(function(...$args) { $this->handleError(...$args); })
			);
	}
	
	
	public function get(): IMySqlConnector
	{
		return $this->mysql->getConnector('main');
	}
}