<?php
namespace Waterfall\DAO\Webhook;


use Squid\MySql\Connectors\IMySqlAutoIncrementConnector;
use Squid\MySql\Impl\Connectors\MySqlAutoIncrementConnector;
use Waterfall\Base\DAO\Connector\IDBConnector;
use Waterfall\Base\DAO\Webhook\IWebhookDAO;
use Waterfall\Core\Objects\Subject;
use Waterfall\Core\Objects\Webhook;


/**
 * @autoload
 */
class WebhookDAO implements IWebhookDAO
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
			->setTable('Webhook')
			->setIdField('ID');
	}


	/**
	 * @param int $id
	 * @return Webhook|null
	 */
	public function get(int $id)
	{
		return $this->objectConnector->load($id) ?: null;
	}

	/**
	 * @param string $key
	 * @return Webhook|null
	 */
	public function getByKey(string $key)
	{
		return $this->objectConnector->loadOneByField('WebhookKey', $key) ?: null;
	}

	public function save(Webhook $webhook): bool 
	{
		return $this->objectConnector->save($webhook);
	}

	public function delete(int $id): bool 
	{
		return $this->objectConnector->delete($id);
	}

	/**
	 * @return Webhook[]
	 */
	public function all(): array
	{
		$webhooksArray = $this->connector->get()
			->select()
			->from('Webhook')
			->queryAll(true);
		
		if (!$webhooksArray) return $webhooksArray;
		return Webhook::allFromArray($webhooksArray);
	}

	/**
	 * @return Subject[]
	 */
	public function getSubjects(int $webhookID): array
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
}