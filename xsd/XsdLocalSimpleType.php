<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdSimpleType.php';


class XsdLocalSimpleType extends XsdSimpleType
{
	private static $attributes = array(
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
	
}