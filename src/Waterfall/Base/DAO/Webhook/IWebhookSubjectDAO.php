<?php
namespace Waterfall\Base\DAO\Webhook;


use Waterfall\Core\Objects\Subject;
use Waterfall\Core\Objects\WebhookSubject;


interface IWebhookSubjectDAO
{
	public function add(int $webhookID, int $subjectID);
	public function delete(int $webhookID, int $subjectID);

	/**
	 * @return WebhookSubject[]
	 */
	public function getForWebhook(int $webhookID): array;
	
	/**
	 * @return Subject[]
	 */
	public function getForSubject(int $subject): array;
}