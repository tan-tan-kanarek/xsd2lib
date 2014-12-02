<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdVariable.php';

class XsdBoolean extends XsdVariable
{
	public function __construct(SimpleXMLElement $xml)
	{
		parent::__construct($xml);
		
		if($this->value === 'true')
			$this->value = true;
		elseif($this->value === 'false')
			$this->value = false;
		else
			$this->value = (bool)$this->value;
	}
}