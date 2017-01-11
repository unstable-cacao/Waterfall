<?php
namespace Waterfall\Base\DAO\Subject;


use Waterfall\Core\Objects\Subject;
use Waterfall\Core\Objects\Webhook;


interface ISubjectDAO
{
	public function save(Subject $subject);
	public function delete(int $id);
	
	/**
	 * @return Subject[]
	 */
	public function getAll(): array;
	
	/**
	 * @return Webhook[]
	 */
	public function getWebhooks(int $subjectID): array;
}