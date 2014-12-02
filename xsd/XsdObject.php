<?php
class XsdObject
{
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var XsdObject
	 */
	protected $parent;
	
	/**
	 * @var string
	 */
	protected $xml;
	
	/**
	 * @var string
	 */
	protected $xmlName;
	
	/**
	 * @var string
	 */
	protected $xmlNamespace;
	
	public function __construct(SimpleXMLElement $xml, XsdObject $parent = null)
	{
		$this->parent = $parent;
		$this->xml = $xml->asXML();
		$this->xmlName = $xml->getName();
		$namespaces = array_keys($xml->getNamespaces());
		$this->xmlNamespace = reset($namespaces);
		
		$attributes = $xml->attributes();
		$attributeNames = call_user_func(array(get_class($this), 'getAttributes'));
		foreach ($attributeNames as $attributeName => $type)
		{
			if(isset($attributes->$attributeName))
			{
				$this->$attributeName = $this->getXmlValue($attributes->$attributeName, $type);
			}
		}
	
		$children = $xml->children($this->xmlNamespace, true);
		$childrenNames = call_user_func(array(get_class($this), 'getChildren'));
		foreach ($children as $child)
		{
			/* @var $child SimpleXMLElement */
			$nodeName = $child->getName();
			if(isset($childrenNames[$nodeName]))
			{
				$type = $childrenNames[$nodeName];
				$nodeName = lcfirst($nodeName);
				$matches = null;
				if(preg_match('/^array<([^>]+)>$/', $type, $matches))
				{
					$type = $matches[1];
					$nodeName .= 'Objects'; 
					array_push($this->$nodeName, $this->getXmlValue($child, $type));
				}
				else 
				{
					$require = __DIR__ . DIRECTORY_SEPARATOR . $type . '.php';
					if(file_exists($require))
						require_once $require;
					
					if(!class_exists($type))
						throw new Exception("Class [$type] not found in class [" . get_class($this) . "]");
					$this->$nodeName = $this->getXmlValue($child, $type);
				}
			}
		}
	}
	
	protected function getXmlValue(SimpleXMLElement $value, $type)
	{
		$matches = null;
		if(preg_match('/^array<([^>]+)>$/', $type, $matches))
		{
			$type = $matches[1];
			$values = explode(' ', $value);
			foreach($values as &$value)
				$value = $this->getXmlValue($value, $type);
				
			return $values;
		}
		
		switch ($type)
		{
			case 'string':
				return strval($value);
			case 'int':
				return intval($value);
			case 'float':
			case 'double':
				return floatval($value);
			case 'boolean':
				return (bool) $value;
			default:
				$require = __DIR__ . DIRECTORY_SEPARATOR . $type . '.php';
				if(file_exists($require))
					require_once $require;
				
				if(class_exists($type))
					return new $type($value, $this);
					
				throw new Exception("Type [$type] could not be handled in class [" . get_class($this) . "]");
		}
	}
	
	public function getParsedXml()
	{
		return $this->xml;
	}
	
	public function __toString()
	{
		return $this->__toXml()->asXML();
	}
	
	/**
	 * @return SimpleXMLElement
	 */
	public function __toXml(SimpleXMLElement $xml = null)
	{
		$nodeName = $this->xmlName;
		if($this->xmlNamespace)
			$nodeName = "$this->xmlNamespace:$this->xmlName";
				
		if($xml)
		{
			$xml = $xml->addChild($nodeName);
		}
		else 
		{				
			$xml = new SimpleXMLElement("<$nodeName/>");
		}
		
		$attributeNames = call_user_func(array(get_class($this), 'getAttributes'));
		foreach ($attributeNames as $attributeName => $type)
		{
			if(!is_null($this->$attributeName))
			{
				$xml->addAttribute($attributeName, strval($this->$attributeName));
			}
		}
	
		$childrenNames = call_user_func(array(get_class($this), 'getChildren'));
		foreach ($childrenNames as $childName => $type)
		{
			$method = "get{$childName}";
			if(!is_null($this->$method()))
			{
				$value = $this->$method();
				if(is_array($value))
				{
					foreach($value as $val)
					{
						if($val instanceof DashObject)
						{
							$val->__toXml($xml);
						}
						else
						{
							$xml->addChild($childName, $val);
						}
					}					
				}
				else
				{
					if($value instanceof DashObject)
					{
						$value->__toXml($xml);
					}
					else
					{
						$xml->addChild($childName, $value);
					}
				}
			}
		} 
		
		return $xml;
	}
	
	protected static function getAttributes()
	{
		return array(
			'id' => 'string',
		);
	}

	protected static function getChildren()
	{
		return array();
	}
	
	/**
	 * @return the $id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return the $xmlName
	 */
	public function getXmlName()
	{
		return $this->xmlName;
	}

	/**
	 * @return the $xmlNamespace
	 */
	public function getXmlNamespace()
	{
		return $this->xmlNamespace;
	}

	/**
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @param string $xmlName
	 */
	public function setXmlName($xmlName)
	{
		$this->xmlName = $xmlName;
	}

	/**
	 * @param string $xmlNamespace
	 */
	public function setXmlNamespace($xmlNamespace)
	{
		$this->xmlNamespace = $xmlNamespace;
	}
	
	/**
	 * @return XsdObject
	 */
	public function getParent()
	{
		return $this->parent;
	}
}