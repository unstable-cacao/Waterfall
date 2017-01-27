<?php
namespace Waterfall\Base\DAO\Webhook;


use Waterfall\Core\Objects\Subject;
use Waterfall\Core\Objects\Webhook;


interface IWebhookDAO
{
	public function get(int $id): Webhook;
	public function getByKey(string $key): Webhook;
	public function save(Webhook $webhook);
	public function delete(int $id);

	/**
	 * @return Webhook[]
	 */
	public function all(): array;
	
	/**
	 * @return Subject[]
	 */
	public function getSubjects(int $webhookID): array;
}