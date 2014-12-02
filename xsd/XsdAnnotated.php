<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdOpenAttrs.php';


class XsdAnnotated extends XsdOpenAttrs
{
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var array<XsdAnnotation>
	 */
	protected $annotationObjects = array();
	
	private static $attributes = array(
		'id' => 'string',
	);
	
	private static $children = array(
		'annotation' => 'array<XsdAnnotation>',
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
	 * @return array<XsdAnnotation>
	 */
	public function getAnnotationObjects()
	{
		return $this->annotationObjects;
	}

	/**
	 * @param array<XsdAnnotation> $annotationObjects
	 */
	public function setAnnotationObjects(array $annotationObjects)
	{
		$this->annotationObjects = $annotationObjects;
	}
	
	/**
	 * @return array<XsdAnnotation>
	 */
	public function getAnnotation()
	{
		return reset($this->annotationObjects);
	}
	
}