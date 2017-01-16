<?php
namespace Waterfall\Core\Objects;


use Objection\LiteObject;
use Objection\LiteSetup;
use Waterfall\Core\Enum\WebhookOnFailAction;
use Waterfall\Core\Enum\WebhookState;


/**
 * @property int		$ID
 * @property \DateTime	$Created
 * @property \DateTime	$Modified
 * @property string		$URL
 * @property string		$WebhookKey
 * @property string		$Secret
 * @property string		$State
 * @property int		$MaxRetries
 * @property string		$OnFail
 */
class Webhook extends LiteObject
{
	/**
	 * @return array
	 */
	protected function _setup()
	{
		return [
			'ID' 			=> LiteSetup::createInt(null),
			'Created' 		=> LiteSetup::createDateTime(),
			'Modified' 		=> LiteSetup::createDateTime(),
			'URL' 			=> LiteSetup::createString(null),
			'WebhookKey'	=> LiteSetup::createString(null),
			'Secret'		=> LiteSetup::createString(null),
			'State' 		=> LiteSetup::createEnum(WebhookState::class),
			'MaxRetries' 	=> LiteSetup::createInt(null),
			'OnFail' 		=> LiteSetup::createEnum(WebhookOnFailAction::class)
		];
	}
}