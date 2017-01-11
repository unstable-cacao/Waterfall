<?php
use Skeleton\ConfigLoader\DirectoryConfigLoader;
use Waterfall\Exceptions\WaterfallException;


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
	 * 
	 */
	public static function config()
	{
		self::$skeleton = new Skeleton();
		self::$skeleton
			->enableKnot()
			->registerGlobalFor('Waterfall')
			->setConfigLoader(
				new DirectoryConfigLoader(realpath(__DIR__ . '/../skeleton'))
			);
	}
}