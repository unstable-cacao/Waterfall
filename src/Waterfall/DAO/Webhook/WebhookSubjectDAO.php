<?php
namespace Waterfall\DAO\Webhook;


use Waterfall\Base\DAO\Connector\IDBConnector;
use Waterfall\Base\DAO\Webhook\IWebhookSubjectDAO;
use Waterfall\Core\Objects\Subject;
use Waterfall\Core\Objects\Webhook;


/**
 * @autoload
 */
class WebhookSubjectDAO implements IWebhookSubjectDAO
{
	/** @var IDBConnector */
	private $connector;
	

	public function add(int $webhookID, int $subjectID): bool 
	{
		return $this->connector->get()
			->insert()
			->into('WebhookSubject')
			->values([
				'WebhookID' => $webhookID,
				'SubjectID' => $subjectID
			])
			->executeDml();
	}

	public function delete(int $webhookID, int $subjectID): bool 
	{
		return $this->connector->get()
			->delete()
			->from('WebhookSubject')
			->byField('WebhookID', $webhookID)
			->byField('SubjectID', $subjectID)
			->executeDml();
	}

	/**
	 * @return Subject[]
	 */
	public function getForWebhook(int $webhookID): array
	{
		$subjectsArray = $this->connector->get()
			->select()
			->column('s.*')
			->from('WebhookSubject', 'ws')
			->join('Subject', 's', 's.ID = ws.SubjectID')
			->byField('ws.WebhookID', $webhookID)
			->queryAll(true);
		
		if (!$subjectsArray) return $subjectsArray;
		return Subject::allFromArray($subjectsArray);
	}

	/**
	 * @return Webhook[]
	 */
	public function getForSubject(int $subjectID): array
	{
		$webhooksArray = $this->connector->get()
			->select()
			->column('w.*')
			->from('WebhookSubject', 'ws')
			->join('Webhook', 'w', 'w.ID = ws.WebhookID')
			->byField('ws.SubjectID', $subjectID)
			->queryAll(true);
		
		if (!$webhooksArray) return $webhooksArray;
		return Webhook::allFromArray($webhooksArray);
	}
}