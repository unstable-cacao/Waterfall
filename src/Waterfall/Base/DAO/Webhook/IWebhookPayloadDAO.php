<?php
namespace Waterfall\Base\DAO\Webhook;


use Waterfall\Core\Objects\Payload;
use Waterfall\Core\Objects\WebhookPayload;


interface IWebhookPayloadDAO
{
	public function add(int $id, Payload $payload);
	public function getNextPayloadForWebhook(int $webhookID): WebhookPayload;
	public function update(WebhookPayload $webhookPayload);
}