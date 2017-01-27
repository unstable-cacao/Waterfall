<?php
namespace Waterfall\DAO\Payload;


use Squid\MySql\Connectors\IMySqlAutoIncrementConnector;
use Squid\MySql\Impl\Connectors\MySqlAutoIncrementConnector;
use Waterfall\Base\DAO\Connector\IDBConnector;
use Waterfall\Base\DAO\Payload\IPayloadDAO;
use Waterfall\Core\Enum\WebhookPayloadState;
use Waterfall\Core\Objects\Payload;


/**
 * @autoload
 */
class PayloadDAO implements IPayloadDAO
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
			->setTable('Payload')
			->setIdField('ID');
	}
	
	
	public function save(Payload $payload): bool 
	{
		return $this->objectConnector->save($payload);
	}

	public function delete(int $id): bool 
	{
		return $this->objectConnector->delete($id);
	}

	public function clean(int $beforeUnixTime, int $maxCount = 10240)
	{
		return $this->connector->get()
			->delete()
			->from('Payload')
			->where('Created < ?', $beforeUnixTime)
			->whereExists(
				$this->connector->get()
					->select()
					->from('WebhookPayload')
					->whereIn('State', [WebhookPayloadState::SKIP, WebhookPayloadState::PROCESSED])
					->where('Payload.ID = WebhookPayload.PayloadID')
			)
			->limitBy($maxCount)
			->executeDml();
	}

	/**
	 * Get number of payloads per webhook
	 * @param int $webhook
	 * @param string|null $payloadState
	 * @return int
	 */
	public function count(int $webhook, $payloadState = null)
	{
		$select = $this->connector->get()
			->select()
			->from('WebhookPayload', 'wp')
			->join('Payload', 'p', 'p.ID = wp.PayloadID')
			->byField('wp.WebhookID', $webhook);
		
		if ($payloadState) {
			$select->byField('p.State', $payloadState);
		}
		
		return $select->queryCount();
	}
}