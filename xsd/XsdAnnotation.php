<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdOpenAttrs.php';


class XsdAnnotation extends XsdOpenAttrs
{
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var array<XsdAppinfo>
	 */
	protected $appinfoObjects = array();
	
	/**
	 * @var array<XsdDocumentation>
	 */
	protected $documentationObjects = array();
	
	private static $attributes = array(
		'id' => 'string',
	);
	
	private static $children = array(
		'appinfo' => 'array<XsdAppinfo>',
		'documentation' => 'array<XsdDocumentation>',
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
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * @return array<XsdAppinfo>
	 */
	public function getAppinfoObjects()
	{
		return $this->appinfoObjects;
	}

	/**
	 * @param array<XsdAppinfo> $appinfoObjects
	 */
	public function setAppinfoObjects(array $appinfoObjects)
	{
		$this->appinfoObjects = $appinfoObjects;
	}
	
	/**
	 * @return array<XsdAppinfo>
	 */
	public function getAppinfo()
	{
		return reset($this->appinfoObjects);
	}
	
	/**
	 * @return array<XsdDocumentation>
	 */
	public function getDocumentationObjects()
	{
		return $this->documentationObjects;
	}

	/**
	 * @param array<XsdDocumentation> $documentationObjects
	 */
	public function setDocumentationObjects(array $documentationObjects)
	{
		$this->documentationObjects = $documentationObjects;
	}
	
	/**
	 * @return array<XsdDocumentation>
	 */
	public function getDocumentation()
	{
		return reset($this->documentationObjects);
	}
	
}