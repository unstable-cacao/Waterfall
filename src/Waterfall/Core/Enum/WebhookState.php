<?php
namespace Waterfall\Core\Enum;


class WebhookState
{
	use \Objection\TEnum;

	
	const ACTIVE 	= 'active';
	const DISABLED 	= 'disabled';
	const PAUSED 	= 'paused';
}