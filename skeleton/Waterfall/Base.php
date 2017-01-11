<?php
namespace Waterfall\Base;
/** @var \Skeleton\Base\IBoneConstructor $this */


use Waterfall\DAO\DBConnector;
use Waterfall\Base\DAO\Connector\IDBConnector;

$this->set(IDBConnector::class, DBConnector::class);