<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdVariable.php';

class XsdFloat extends XsdVariable
{
	public function __construct(SimpleXMLElement $xml)
	{
		parent::__construct($xml);
		if(!is_numeric($this->value))
			throw new Exception("Value [$this->value] in class [" . get_class($this) . "] is not numeric");
			
		$this->value = floatval($this->value);
	}
}