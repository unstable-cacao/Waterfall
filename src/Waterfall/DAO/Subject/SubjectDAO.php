<?php
namespace Waterfall\DAO\Subject;


use Squid\MySql\Connectors\IMySqlAutoIncrementConnector;
use Squid\MySql\Impl\Connectors\MySqlAutoIncrementConnector;
use Waterfall\Base\DAO\Connector\IDBConnector;
use Waterfall\Base\DAO\Subject\ISubjectDAO;
use Waterfall\Core\Objects\Subject;
use Waterfall\Core\Objects\Webhook;


/**
 * @autoload
 */
class SubjectDAO implements ISubjectDAO
{
	/** @var IDBConnector */
	private $connector;
	
	/** @var IMySqlAutoIncrementConnector */
	private $objectConnector;
	
	
	public function __construct()
	{
		$this->objectConnector = new MySqlAutoIncrementConnector();
		$this->objectConnector
			->setConnector($this->connector->get())
			->setTable('Subject')
			->setIdField('ID');
	}


	public function save(Subject $subject): bool 
	{
		return $this->objectConnector->save($subject);
	}

	public function delete(int $id): bool 
	{
		return $this->objectConnector->delete($id);
	}

	/**
	 * @return Subject[]
	 */
	public function getAll(): array
	{
		$subjectsArray = $this->connector->get()
			->select()
			->from('Subject')
			->queryAll(true);
		
		if (!$subjectsArray) return $subjectsArray;
		return Subject::allFromArray($subjectsArray);
	}

	/**
	 * @return Webhook[]
	 */
	public function getWebhooks(int $subjectID): array
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