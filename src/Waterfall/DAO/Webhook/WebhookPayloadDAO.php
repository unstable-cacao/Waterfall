<?php
namespace Waterfall\DAO\Webhook;


use Waterfall\Base\DAO\Connector\IDBConnector;
use Waterfall\Base\DAO\Webhook\IWebhookPayloadDAO;
use Waterfall\Core\Objects\Payload;
use Waterfall\Core\Objects\WebhookPayload;


/**
 * @autoload
 */
class WebhookPayloadDAO implements IWebhookPayloadDAO
{
	/** @var IDBConnector */
	private $connector;
	
	
	public function add(int $id, Payload $payload): bool 
	{
		// TODO
	}

	public function getNextPayloadForWebhook(int $webhookID): WebhookPayload
	{
		// TODO: Implement getNextPayloadForWebhook() method.
	}

	public function update(WebhookPayload $webhookPayload)
	{
		// TODO: Implement update() method.
	}
}