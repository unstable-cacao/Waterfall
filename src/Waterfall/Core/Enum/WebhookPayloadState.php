<?php
namespace Waterfall\Core\Enum;


class WebhookPayloadState
{
	use \Objection\TEnum;
	
	
	const PENDING 		= 'pending';
	const SKIP 			= 'skip';
	const PROCESSED 	= 'processed';
}