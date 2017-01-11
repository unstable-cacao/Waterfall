<?php
namespace Waterfall\Core\Enum;


class WebhookOnFailAction
{
	use \Objection\TEnum;
	
	
	const ABORT 			= 'abort';
	const CONTINUE_REQUEST 	= 'continue';
	const PAUSE 			= 'pause';
}