<?php
namespace Waterfall\Base\Sync;


interface IWebhookSync
{
	public function executeFromLock(int $webhookID, callable $callback);
}