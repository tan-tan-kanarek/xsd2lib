<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdWildcard.php';


class XsdAnyAttribute extends XsdWildcard
{
	/**
	 * @var XsdQnameListA
	 */
	protected $notQName;
	
	private static $attributes = array(
		'notQName' => 'XsdQnameListA',
	);
	
	private static $children = array(
	);
	
	protected static function getAttributes()
	{
		return array_merge(parent::getAttributes(), self::$attributes);
	}
	
	protected static function getChildren()
	{
		return array_merge(parent::getChildren(), self::$children);
	}
	
	/**
	 * @return XsdQnameListA
	 */
	public function getNotQName()
	{
		return $this->notQName;
	}

	/**
	 * @param XsdQnameListA $notQName
	 */
	public function setNotQName(XsdQnameListA $notQName)
	{
		$this->notQName = $notQName;
	}
	
}