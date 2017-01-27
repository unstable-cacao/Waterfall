<?php
namespace Waterfall\Base\DAO\Webhook;


use Waterfall\Core\Objects\Subject;
use Waterfall\Core\Objects\Webhook;


interface IWebhookSubjectDAO
{
	public function add(int $webhookID, int $subjectID);
	public function delete(int $webhookID, int $subjectID);

	/**
	 * @return Subject[]
	 */
	public function getForWebhook(int $webhookID): array;
	
	/**
	 * @return Webhook[]
	 */
	public function getForSubject(int $subjectID): array;
}