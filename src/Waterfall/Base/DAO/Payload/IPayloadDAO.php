<?php
namespace Waterfall\Base\DAO\Payload;


use Waterfall\Core\Objects\Payload;


interface IPayloadDAO
{
	public function save(Payload $payload);
	public function delete(int $id);
	public function clean(int $beforeUnixTime, int $maxCount = 10240);

	/**
	 * Get number of payloads per webhook
	 * @param int $webhook
	 * @param null $payloadState
	 * @return mixed
	 */
	public function count(int $webhook, $payloadState = null);
}