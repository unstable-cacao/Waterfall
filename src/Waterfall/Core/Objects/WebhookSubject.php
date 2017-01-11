<?php
namespace Waterfall\Core\Objects;


use Objection\LiteObject;
use Objection\LiteSetup;


/**
 * @property int $WebhookID
 * @property int $SubjectID
 */
class WebhookSubject extends LiteObject
{
	/**
	 * @return array
	 */
	protected function _setup()
	{
		return [
			'WebhookID'	=> LiteSetup::createInt(null),
			'SubjectID'	=> LiteSetup::createInt(null)
		];
	}
}