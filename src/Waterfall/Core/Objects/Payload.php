<?php
namespace Waterfall\Core\Objects;


use Objection\LiteObject;
use Objection\LiteSetup;


/**
 * @property int		$ID
 * @property \DateTime	$Created
 * @property \DateTime	$Modified
 * @property string		$Data
 */
class Payload extends LiteObject
{
	/**
	 * @return array
	 */
	protected function _setup()
	{
		return [
			'ID' 		=> LiteSetup::createInt(null),
			'Created' 	=> LiteSetup::createDateTime(),
			'Modified' 	=> LiteSetup::createDateTime(),
			'Data' 		=> LiteSetup::createString(null)
		];
	}
}