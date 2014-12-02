<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdAnnotated.php';


class XsdWildcard extends XsdAnnotated
{
	/**
	 * @var XsdNamespaceList
	 */
	protected $namespace;
	
	/**
	 * @var XsdBasicNamespaceList
	 */
	protected $notNamespace;
	
	/**
	 * @var string
	 */
	protected $processContents;
	
	private static $attributes = array(
		'namespace' => 'XsdNamespaceList',
		'notNamespace' => 'XsdBasicNamespaceList',
		'processContents' => 'string',
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
	 * @return XsdNamespaceList
	 */
	public function getNamespace()
	{
		return $this->namespace;
	}

	/**
	 * @param XsdNamespaceList $namespace
	 */
	public function setNamespace(XsdNamespaceList $namespace)
	{
		$this->namespace = $namespace;
	}
	
	/**
	 * @return XsdBasicNamespaceList
	 */
	public function getNotNamespace()
	{
		return $this->notNamespace;
	}

	/**
	 * @param XsdBasicNamespaceList $notNamespace
	 */
	public function setNotNamespace(XsdBasicNamespaceList $notNamespace)
	{
		$this->notNamespace = $notNamespace;
	}
	
	/**
	 * @return string
	 */
	public function getProcessContents()
	{
		return $this->processContents;
	}

	/**
	 * @param string $processContents
	 */
	public function setProcessContents($processContents)
	{
		$this->processContents = $processContents;
	}
	
}