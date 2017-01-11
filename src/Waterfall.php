<?php
use Waterfall\Config\Config;
use Waterfall\Exceptions\WaterfallException;

use Skeleton\Type;
use Skeleton\ConfigLoader\DirectoryConfigLoader;
use Objection\Mapper;


use Skeleton\Skeleton;


class Waterfall
{
	use \Objection\TStaticClass;
	
	
	/** @var Skeleton */
	private static $skeleton = null;


	/**
	 * @param string|null $interface
	 * @return object|Skeleton|string
	 */
	public static function skeleton($interface = null) 
	{
		if (!self::$skeleton)
			throw new WaterfallException('Waterfall was not configured! Waterfall::config() must be called first');
		
		if ($interface)
		{
			return self::$skeleton->get($interface);
		}
		else 
		{
			return self::$skeleton;
		}
	}
	
	/**
	 * @param string|\stdClass|array $config
	 */
	public static function config($config)
	{
		self::$skeleton = new Skeleton();
		self::$skeleton
			->enableKnot()
			->registerGlobalFor('Waterfall')
			->setConfigLoader(
				new DirectoryConfigLoader(realpath(__DIR__ . '/../skeleton'))
			);
		
		$config = Mapper::getObjectFrom(Config::class, $config);
		self::$skeleton->set(Config::class, $config, Type::ByValue);
	}
}