<?php
class XsdVariable
{
	protected $value;
	
	public function __construct(SimpleXMLElement $xml)
	{
		$this->value = strval($xml);
	}
	
	public function __toString()
	{
		return strval($this->value);
	}
	
	public function getXmlValue()
	{
		return $this->value;
	}
}