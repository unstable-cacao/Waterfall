<?php
namespace Waterfall\Config;


use Objection\LiteSetup;
use Objection\LiteObject;

use Waterfall\Core\Enum\WebhookOnFailAction;


/**
 * @property int $MaxRetries
 * @property int $MaxBacklogSize
 * @property int $MaxBacklogDateInSeconds
 * @property int $MaxPendingPayloads
 * @property WebhookOnFailAction $OnFailAction
 */
class DefaultValues extends LiteObject 
{
	/**
	 * @return array
	 */
	protected function _setup()
	{
		return [
			'MaxRetries'                => LiteSetup::createInt(3),
			'MaxBacklogSize'            => LiteSetup::createInt(10 * 1000),
			'MaxBacklogDateInSeconds'   => LiteSetup::createInt(24 * 60 * 60),
			'MaxPendingPayloads'        => LiteSetup::createInt(100 * 1000),
			'MaxRetries'    => LiteSetup::createInt(3),
			'OnFailAction'  => LiteSetup::createEnum(WebhookOnFailAction::class, WebhookOnFailAction::PAUSE)
		];
	}
}