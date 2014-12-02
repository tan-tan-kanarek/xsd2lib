<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdWildcard.php';


class XsdAny extends XsdWildcard
{
	/**
	 * @var XsdQnameList
	 */
	protected $notQName;
	
	/**
	 * @var int
	 */
	protected $minOccurs;
	
	/**
	 * @var XsdAllNNI
	 */
	protected $maxOccurs;
	
	private static $attributes = array(
		'notQName' => 'XsdQnameList',
		'minOccurs' => 'int',
		'maxOccurs' => 'XsdAllNNI',
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
	 * @return XsdQnameList
	 */
	public function getNotQName()
	{
		return $this->notQName;
	}

	/**
	 * @param XsdQnameList $notQName
	 */
	public function setNotQName(XsdQnameList $notQName)
	{
		$this->notQName = $notQName;
	}
	
	/**
	 * @return int
	 */
	public function getMinOccurs()
	{
		return $this->minOccurs;
	}

	/**
	 * @param int $minOccurs
	 */
	public function setMinOccurs($minOccurs)
	{
		$this->minOccurs = $minOccurs;
	}
	
	/**
	 * @return XsdAllNNI
	 */
	public function getMaxOccurs()
	{
		return $this->maxOccurs;
	}

	/**
	 * @param XsdAllNNI $maxOccurs
	 */
	public function setMaxOccurs(XsdAllNNI $maxOccurs)
	{
		$this->maxOccurs = $maxOccurs;
	}
	
}