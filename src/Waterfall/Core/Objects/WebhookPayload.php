<?php
namespace Waterfall\Core\Objects;


use Objection\LiteObject;
use Objection\LiteSetup;
use Waterfall\Core\Enum\WebhookPayloadState;


/**
 * @property int	$WebhookID
 * @property int	$PayloadID
 * @property string	$State
 * @property bool	$IsProcessing
 * @property int	$Retries
 */
class WebhookPayload extends LiteObject
{
	/**
	 * @return array
	 */
	protected function _setup()
	{
		return [
			'WebhookID' 	=> LiteSetup::createInt(null),
			'PayloadID' 	=> LiteSetup::createInt(null),
			'State' 		=> LiteSetup::createEnum(WebhookPayloadState::class),
			'IsProcessing' 	=> LiteSetup::createBool(),
			'Retries' 		=> LiteSetup::createInt(null)
		];
	}
}