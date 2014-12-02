<?php
require_once __DIR__ . '/xsd/XsdSchema.php';

class LibGenerator
{
	/**
	 * @var string
	 */
	protected $prefix;
	
	/**
	 * @var XsdSchema
	 */
	protected $schema;
	
	/**
	 * @var array
	 */
	protected $topElements = array();
	
	/**
	 * @var array
	 */
	protected $types = array();
	
	/**
	 * @var array
	 */
	protected $classes = array();
	
	/**
	 * @var array
	 */
	protected $addedClasses = array();
	
	/**
	 * @var array
	 */
	protected $references = array();
	
	public function __construct($url, $prefix)
	{
		$this->prefix = $prefix;
		
		$this->load($url, $prefix);
	}

	public function resolveUrl($targetUrl, $referenceUrl)
	{
		$host = null;
		$scheme = null;
		
	    /* return if already absolute URL */
	    if (parse_url($targetUrl, PHP_URL_SCHEME) != '') 
	    	return $targetUrl;
	
	    /* queries and anchors */
	    if ($targetUrl[0]=='#' || $targetUrl[0]=='?') 
	    	return $referenceUrl.$targetUrl;
	
	    /* parse base URL and convert to local variables:
	       $scheme, $host, $path */
	    extract(parse_url($referenceUrl));
	
	    /* remove non-directory element from path */
	    $path = preg_replace('#/[^/]*$#', '', $path);
	
	    /* destroy path if relative url points to root */
	    if ($targetUrl[0] == '/') 
	    	$path = '';
	
	    /* dirty absolute URL */
	    $abs = "$host$path/$targetUrl";
	
	    /* replace '//' or '/./' or '/foo/../' with '/' */
	    $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
	    for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}
	
	    /* absolute URL is ready! */
	    return $scheme.'://'.$abs;
	}
	
	protected function import(XsdImport $import, $parentUrl, $namespace)
	{
		$url = $this->resolveUrl($import->getSchemaLocation(), $parentUrl);
		
		echo "Importing [$url]\n";
		$this->load($url, $this->prefix . ucfirst($namespace), $namespace);
	}
	
	protected function load($url, $prefix, $namespace = null)
	{		
		$xsd = new SimpleXMLElement($url, LIBXML_NSCLEAN, true);
		$schema = new XsdSchema($xsd);
		if(is_null($namespace))
		{	
			$this->schema = $schema;
			$namespace = $schema->getXmlNamespace();
		}
		
		$doc = new DOMDocument();
		$doc->load($url);
		foreach ($schema->getImportObjects() as $import)
		{
			/* @var $import XsdImport */
			$importNamespace = $doc->lookupPrefix($import->getNamespace());
			$this->import($import, $url, $importNamespace);
		}
	
		foreach($schema->getGroupObjects() as $group)
		{
			/* @var $element XsdElement */
			$this->references[$namespace . ':' . $group->getName()] = $group;
		}
	
		foreach($schema->getAttributeGroupObjects() as $group)
		{
			/* @var $element XsdElement */
			$this->references[$namespace . ':' . $group->getName()] = $group;
		}
	
		foreach($schema->getElementObjects() as $element)
		{
			/* @var $element XsdElement */
			$this->topElements[] = $element->getName();
			$this->references[$namespace . ':' . $element->getName()] = $element;
			$this->loadObject($element, $prefix);
		}
	
		foreach($schema->getAttributeObjects() as $attribute)
		{
			/* @var $attribute XsdAttribute*/
			$this->references[$namespace . ':' . $attribute->getName()] = $attribute;
		}
		
		foreach($schema->getComplexTypeObjects() as $type)
		{
			/* @var $type XsdComplexType */
			$this->loadType($type, $prefix);
		}
		
		foreach($schema->getSimpleTypeObjects() as $type)
		{
			/* @var $type XsdComplexType */
			$this->loadType($type, $prefix);
		}
	}
	
	protected function loadType($type, $prefix, $name = null)
	{
		if(!$name)
			$name = $type->getName();
		if(!$name)
			throw new Exception("Name not found for type");
			
		$className = $prefix . ucfirst($name);
		$typeName = $type->getName();
		if($type->getXmlNamespace() != $this->schema->getXmlNamespace())
		{
			$typeName = $type->getXmlNamespace() . ':' . $type->getName();	
		}
		echo "Loading type [$className]\n";
		$this->types[$typeName] = $className;
		$this->classes[$className] = $type;
	}
	
	protected function loadObject(XsdElement $element, $prefix)
	{
		if(!$element->getName())
			return;
			
		if(method_exists($element, 'getComplexType') && $element->getComplexType())
		{
			$this->loadType($element->getComplexType(), $prefix, $element->getName());
			$children = $this->getElements($element);
			foreach($children as $child)
			{
				/* @var $child XsdElement */
				if(is_null($child->getRef()) && is_null($child->getType()) && $child->getComplexType())
				{
					$this->loadObject($child, $prefix . ucfirst($element->getName()));
				}
			}
		}
			
		if(method_exists($element, 'getComplexTypeObjects'))
		{
			foreach($element->getComplexTypeObjects() as $complexType)
			{
				$this->loadType($complexType, $prefix, $element->getName());
				$children = $this->getElements($element);
				foreach($children as $child)
				{
					/* @var $child XsdElement */
					if(is_null($child->getRef()) && is_null($child->getType()) && $child->getComplexType())
					{
						$this->loadObject($child, $prefix . ucfirst($element->getName()));
					}
				}
			}
		}
			
		if(method_exists($element, 'getSimpleType') && $element->getSimpleType())
			$this->loadType($element->getSimpleType(), $prefix, $element->getName());
			
		if(method_exists($element, 'getSimpleTypeObjects'))
		{
			foreach($element->getSimpleTypeObjects() as $simpleType)
				$this->loadType($simpleType, $prefix, $element->getName());
		}
	}
	
	protected function getAttributeType($type)
	{
		if(method_exists($type, 'getType') && $type->getType())
		{
			return $this->getType($type->getType());
		}
		
		if(method_exists($type, 'getBase') && $type->getBase())
		{
			return $this->getType($type->getBase());
		}
		
		if(method_exists($type, 'getItemType') && $type->getItemType())
		{
			return $this->getType($type->getItemType());
		}
	
		if(method_exists($type, 'getMemberTypes') && $type->getMemberTypes())
		{
			$memberTypes = explode(' ', $type->getMemberTypes());
			$memberType = $this->getType(reset($memberTypes));
			foreach($memberTypes as $currentMemberType)
				if($memberType != $this->getType($currentMemberType))
					return $this->prefix . 'Variable';
			
			return $memberType;
		}
		
		
		
		if(method_exists($type, 'getSimpleType') && $type->getSimpleType())
		{
			return $this->getAttributeType($type->getSimpleType());
		}
		
		if(method_exists($type, 'getRestriction') && $type->getRestriction())
		{
			return $this->getAttributeType($type->getRestriction());
		}
		
		if(method_exists($type, 'getList') && $type->getList())
		{
			return $this->getAttributeType($type->getList());
		}
		
		if(method_exists($type, 'getUnion') && $type->getUnion())
		{
			return $this->getAttributeType($type->getUnion());
		}
		
		return null;
	}
	
	protected function getElementType($type)
	{
		if(method_exists($type, 'getType') && $type->getType())
		{
			return $this->getType($type->getType());
		}
		
		if($type instanceof XsdComplexType && $type->getName())
		{
			return $this->getType($type->getName());
		}
		
		if($type instanceof XsdElement && $type->getName())
		{
			$parentType = null;
			$parent = $type;
			while($parent->getParent())
			{
				$parent = $parent->getParent();
				$parentType = $this->getElementType($parent);
				if($parentType)
					break;
			}
			if($parentType)
			{
				$className = $parentType . ucfirst($type->getName());
				$this->addedClasses[$className] = $type->getComplexType();
				return $this->getType($className);
			}
		}
		
		if(method_exists($type, 'getBase') && $type->getBase())
		{
			return $this->getType($type->getBase());
		}
		
		if(method_exists($type, 'getRef') && $type->getRef())
		{
//			var_dump($type->getRef());
			if(!isset($this->references[$type->getRef()]))
				throw new Exception("Reference " . $type->getXmlName() . " [" . $type->getRef() . "] not found for element");
				
			$reference = $this->references[$type->getRef()];
			return $this->getType($reference);
		}
		
		
		
		if(method_exists($type, 'getSimpleType') && $type->getSimpleType())
		{
			return $this->getElementType($type->getSimpleType());
		}
		
		if(method_exists($type, 'getComplexType') && $type->getComplexType())
		{
			return $this->getElementType($type->getComplexType());
		}
		
		if(method_exists($type, 'getSimpleContent') && $type->getSimpleContent())
		{
			return $this->getElementType($type->getSimpleContent());
		}
		
		if(method_exists($type, 'getComplexContent') && $type->getComplexContent())
		{
			return $this->getElementType($type->getComplexContent());
		}
		
		if(method_exists($type, 'getRestriction') && $type->getRestriction())
		{
			return $this->getElementType($type->getRestriction());
		}
		
		if(method_exists($type, 'getExtension') && $type->getExtension())
		{
			return $this->getElementType($type->getExtension());
		}
		
		if(method_exists($type, 'getExtensionObjects') && $type->getExtensionObjects())
		{
			foreach($type->getExtensionObjects() as $subType)
			{
				$ret = $this->getElementType($subType);
				if($ret)
					return $ret;
			}
		}
		
		if(method_exists($type, 'getRestrictionObjects') && $type->getRestrictionObjects())
		{
			foreach($type->getRestrictionObjects() as $subType)
			{
				$ret = $this->getElementType($subType);
				if($ret)
					return $ret;
			}
		}
		
//		if($type instanceof XsdElement && $type->getName() === 'facet')
			return null;
			
//		var_dump($type);
//		var_dump(get_class($type->getParent()));
//		throw new Exception("Type not found");
	}
	
	protected function getType($type)
	{
		if(!$type)
			throw new Exception("Type is empty");
			
		if(isset($this->types[$type]))
			return $this->types[$type];
			
		if(isset($this->addedClasses[$type]))
			return $type;
		
		if(strpos($type, ':') > 0)
		{
			$parts = explode(':', $type, 2);
			$type = $parts[1];
			if($parts[0] != $this->schema->getXmlNamespace())
			{
				$type = $parts[0] . ucfirst($parts[1]);
			}
		}
		
		$class = $this->prefix . ucfirst($type);
		if(isset($this->classes[$class]))
			return $class;
		
		$validTypes = array(
			'string',
			'int',
			'float',
			'boolean',
		);
		if(in_array($type, $validTypes))
			return $type;
			
		if($type === 'duration')
			return $this->prefix . 'Duration';
			
		$floats = array(
	        'double',
        );
		if(in_array($type, $floats))
			return 'float';
			
		$ints = array(
	        'integer',
			'byte',
			'short',
			'long',
			'decimal',
			'unsignedByte',
			'unsignedInt',
			'unsignedShort',
			'unsignedLong',
			'unsignedLong',
	        'nonPositiveInteger',
	        'negativeInteger',
	        'nonNegativeInteger',
	        'positiveInteger',
	        'gDay',
			'gMonth',
			'gMonthDay',
			'gYear',
			'gYearMonth',
        );
		if(in_array($type, $ints))
			return 'int';
			
		$strings = array(
	        'date',
			'time',
			'dateTime',
			'anyURI',
			'language',
			'token',
			'QName',
			'NCName',
			'ID',
			'NMTOKEN',
        );
		if(in_array($type, $strings))
			return 'string';
			
		throw new Exception("Type $type is invalid");
	}
	
	protected function getAttributes($type, $attributes = array())
	{
		if(method_exists($type, 'getAttributeObjects'))
			$attributes = array_merge($attributes, $type->getAttributeObjects());
	
		if(method_exists($type, 'getRef') && $type->getRef())
		{
			if(!isset($this->references[$type->getRef()]))
				throw new Exception("Reference " . $type->getXmlName() . " [" . $type->getRef() . "] not found in element");
				
			$reference = $this->references[$type->getRef()];
			$attributes = $this->getAttributes($reference, $attributes);
		}
		
		if(method_exists($type, 'getComplexContent') && $type->getComplexContent() && $type->getComplexContent()->getExtension())
			$attributes = $this->getAttributes($type->getComplexContent()->getExtension(), $attributes);
		
		if(method_exists($type, 'getGroupObjects'))
		{
			foreach($type->getGroupObjects() as $subType)
				$attributes = $this->getAttributes($subType, $attributes);
		}
		
		if(method_exists($type, 'getSequenceObjects'))
		{
			foreach($type->getSequenceObjects() as $subType)
				$attributes = $this->getAttributes($subType, $attributes);
		}
		
		if(method_exists($type, 'getChoiceObjects'))
		{
			foreach($type->getChoiceObjects() as $subType)
				$attributes = $this->getAttributes($subType, $attributes);
		}
		
		if(method_exists($type, 'getAttributeGroupObjects'))
		{
			foreach($type->getAttributeGroupObjects() as $subType)
				$attributes = $this->getAttributes($subType, $attributes);
		}
			
		return $attributes;
	}
	
	protected function getElements($type, $elements = array())
	{
		if(method_exists($type, 'getElementObjects'))
			$elements = array_merge($elements, $type->getElementObjects());
		
		if(method_exists($type, 'getRef') && $type->getRef())
		{
			if(!isset($this->references[$type->getRef()]))
				throw new Exception("Reference " . $type->getXmlName() . " [" . $type->getRef() . "] not found in element");
				
			$reference = $this->references[$type->getRef()];
			$elements = $this->getElements($reference, $elements);
		}
		
		if(method_exists($type, 'getComplexContent') && $type->getComplexContent())
			$elements = $this->getElements($type->getComplexContent(), $elements);
		
		if(method_exists($type, 'getComplexType') && $type->getComplexType())
			$elements = $this->getElements($type->getComplexType(), $elements);
		
		if(method_exists($type, 'getExtension') && $type->getExtension())
			$elements = $this->getElements($type->getExtension(), $elements);
		
		if(method_exists($type, 'getComplexContentObjects'))
		{
			foreach($type->getComplexContentObjects() as $subType)
				$elements = $this->getElements($subType, $elements);
		}
		
		if(method_exists($type, 'getComplexTypeObjects'))
		{
			foreach($type->getComplexTypeObjects() as $subType)
				$elements = $this->getElements($subType, $elements);
		}
		
		if(method_exists($type, 'getExtensionObjects'))
		{
			foreach($type->getExtensionObjects() as $subType)
				$elements = $this->getElements($subType, $elements);
		}
		
		if(method_exists($type, 'getGroupObjects'))
		{
			foreach($type->getGroupObjects() as $subType)
				$elements = $this->getElements($subType, $elements);
		}
		
		if(method_exists($type, 'getSequenceObjects'))
		{		
			foreach($type->getSequenceObjects() as $subType)
				$elements = $this->getElements($subType, $elements);
		}
		
		if(method_exists($type, 'getChoiceObjects'))
		{		
			foreach($type->getChoiceObjects() as $subType)
				$elements = $this->getElements($subType, $elements);
		}
		
		return $elements;
	}
	
	protected function writeSimpleType(XsdSimpleType $type, $path, $className)
	{
		echo "Generating $className\n";
		
		$parentClass = $this->getAttributeType($type);
		if($this->isPrimitive($parentClass))
			$parentClass = $this->prefix . ucfirst($parentClass);
		
		$imports = array();
		
		$class = "
class $className extends $parentClass
{";
		
		$class .= "
}";
		
		ksort($imports);
		$imports = implode("\n", $imports);
		$php = "<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '$parentClass.php';

$class";
		
		file_put_contents($path . DIRECTORY_SEPARATOR . "$className.php", $php);
	}
	
	protected static $primitives = array(
		'int',
		'float',
		'string',
		'boolean',
	);
	
	protected function isPrimitive($type)
	{
		return in_array($type, self::$primitives);
	}
	
	protected function writeComplexType(XsdComplexType $type, $path, $className)
	{
		echo "Generating $className\n";
		
		$parentClass = $this->prefix . 'Object';
		if(method_exists($type, 'getComplexContent') && $type->getComplexContent())
		{
			if($type->getComplexContent()->getRestriction() && $type->getComplexContent()->getRestriction()->getBase())
			{
				$parentClass = $this->getType($type->getComplexContent()->getRestriction()->getBase());
			}
			elseif($type->getComplexContent()->getExtension() && $type->getComplexContent()->getExtension()->getBase())
			{
				$parentClass = $this->getType($type->getComplexContent()->getExtension()->getBase());
			}
		}
		
		$imports = array();
		
		$class = "
class $className extends $parentClass
{";
		$attributes = $this->getAttributes($type);
		$attributesHandled = array();
		$attributesTypes = array();
		foreach ($attributes as $attribute)
		{
			/* @var $attribute XsdAttribute */
			if($attribute->getRef())
			{
				if(!isset($this->references[$attribute->getRef()]))
					throw new Exception("Reference attribute [" . $attribute->getRef() . "] not found in class [$className]");
					
				$attribute = $this->references[$attribute->getRef()];
			}
			
			$attributeType = $this->getAttributeType($attribute);
			$attributeName = $attribute->getName();
			if(is_null($attributeType))
			{
				$attributeType = 'string';
				echo "Unknown type [$className::$attributeName]\n";
			}
			if(!$this->isPrimitive($attributeType))
				$imports[$attributeType] = "require_once __DIR__ . DIRECTORY_SEPARATOR . '$attributeType.php';";
				
			$explained = '';
			if($attributeType != $attribute->getType())
				$explained = ' (' . $attribute->getType() . ')';
			$attributesTypes[$attributeName] = $attributeType;
			
			if(isset($attributesHandled[$attributeName]))
				continue;
				
			$attributesHandled[$attributeName] = true;
			
			$class .= "
	/**
	 * @var $attributeType
	 */
	protected \$$attributeName;
	";
			
		}
		
		$children = $this->getElements($type);
		$childrenTypes = array();
		$childrenArrays = array();
		foreach ($children as $child)
		{
			/* @var $child XsdElement */
			if($child->getRef())
			{
				if(!isset($this->references[$child->getRef()]))
					throw new Exception("Reference element [" . $child->getRef() . "] not found in class [$className]");
			
				$child = $this->references[$child->getRef()];
			}
			
			$childType = $this->getElementType($child);
			$childName = $child->getName();
			$childAttributeName = lcfirst($childName);	
			
			if(is_null($childType))
			{
				echo "Unknown type [$className::$childAttributeName]\n";
				$childType = $className . ucfirst($child->getName());
			}
			
			if(!$this->isPrimitive($childType))
				$imports[$childType] = "require_once __DIR__ . DIRECTORY_SEPARATOR . '$childType.php';";
			
			if(!$child->getMaxOccurs() || $child->getMaxOccurs()->getXmlValue() <> 1)
			{
				$childType = "array<$childType>";
				$childrenArrays[] = $childName;
				$childAttributeName .= 'Objects = array()';
			}
			
			$childrenTypes[$childName] = $childType;
			
			
			if(isset($attributesHandled[$childName]))
				continue;
				
			$attributesHandled[$childName] = true;
			
			$class .= "
	/**
	 * @var $childType
	 */
	protected \$$childAttributeName;
	";
		}
		
		$class .= '
	private static $attributes = array(';
		foreach($attributesTypes as $attributeName => $attributeType)
		{
			$class .= "
		'$attributeName' => '$attributeType',";
		}
		$class .= '
	);
	';
	
		$class .= '
	private static $children = array(';
		foreach($childrenTypes as $childName => $childType)
		{
			$class .= "
		'$childName' => '$childType',";
		}
		$class .= '
	);
	';
		
	$class .= '
	protected static function getAttributes()
	{
		return array_merge(parent::getAttributes(), self::$attributes);
	}
	
	protected static function getChildren()
	{
		return array_merge(parent::getChildren(), self::$children);
	}
	';
	
	
	
	foreach($attributesTypes as $attributeName => $attributeType)
	{
		$attributeName = lcfirst($attributeName);
		$attributeMethodName = ucfirst($attributeName);
		$attributeMethodPrefix = '';
		if(!$this->isPrimitive($attributeType))
			$attributeMethodPrefix = "$attributeType ";
			
		$class .= "
	/**
	 * @return $attributeType
	 */
	public function get{$attributeMethodName}()
	{
		return \$this->$attributeName;
	}

	/**
	 * @param $attributeType \$$attributeName
	 */
	public function set{$attributeMethodName}($attributeMethodPrefix\$$attributeName)
	{
		\$this->$attributeName = \$$attributeName;
	}
	";
	}
	
	foreach($childrenTypes as $childName => $childType)
	{
		$childMethodPrefix = '';
		$childAttributeName = $childName;
		if(in_array($childName, $childrenArrays))
		{
			$childAttributeName .= 'Objects';
			$childMethodPrefix = "array ";
		}
		elseif(!$this->isPrimitive($childType))
		{
			$childMethodPrefix = "$childType ";
		}
		$childMethodName = ucfirst($childAttributeName);
		$childAttributeName = lcfirst($childAttributeName);
			
		$class .= "
	/**
	 * @return $childType
	 */
	public function get{$childMethodName}()
	{
		return \$this->$childAttributeName;
	}

	/**
	 * @param $childType \$$childAttributeName
	 */
	public function set{$childMethodName}($childMethodPrefix\$$childAttributeName)
	{
		\$this->$childAttributeName = \$$childAttributeName;
	}
	";
		
		$matches = null;
		if(in_array($childName, $childrenArrays) && preg_match('/^array<([^>]+)>$/', $childType, $matches))
		{
			$childType = $matches[1];
			$childMethodName = ucfirst($childName);
			$class .= "
	/**
	 * @return $childType
	 */
	public function get{$childMethodName}()
	{
		return reset(\$this->$childAttributeName);
	}
	";
		}
	}
	
	
		$class .= "
}";
		
		ksort($imports);
		$imports = implode("\n", $imports);
		$php = "<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '$parentClass.php';

$class";
		
		file_put_contents($path . DIRECTORY_SEPARATOR . "$className.php", $php);
	}
	
	protected function writeBaseVariable($path)
	{
		$variableClassName = $this->prefix . 'Variable';
		$class = '<?php
class ' . $variableClassName . '
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
}';
		file_put_contents($path . DIRECTORY_SEPARATOR . "$variableClassName.php", $class);
		
		
		
		
		$className = $this->prefix . 'Int';
		$class = '<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . \'' . $variableClassName . '.php\';

class ' . $className . ' extends ' . $variableClassName . '
{
	public function __construct(SimpleXMLElement $xml)
	{
		parent::__construct($xml);
		if($this->value === \'unbounded\')
		{
			$this->value = null;
			return;
		}
		
		if(!is_numeric($this->value))
			throw new Exception("Value [$this->value] in class [" . get_class($this) . "] is not numeric");
			
		$this->value = intval($this->value);
	}
}';
		file_put_contents($path . DIRECTORY_SEPARATOR . "$className.php", $class);
		
		
		
		
		$className = $this->prefix . 'Duration';
		// TODO validate format
		$class = '<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . \'' . $variableClassName . '.php\';

class ' . $className . ' extends ' . $variableClassName . '
{
}';
		file_put_contents($path . DIRECTORY_SEPARATOR . "$className.php", $class);
		
		
		
		
		$className = $this->prefix . 'String';
		$class = '<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . \'' . $variableClassName . '.php\';

class ' . $className . ' extends ' . $variableClassName . '
{
}';
		file_put_contents($path . DIRECTORY_SEPARATOR . "$className.php", $class);
		
		
		
		
		$className = $this->prefix . 'Float';
		$class = '<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . \'' . $variableClassName . '.php\';

class ' . $className . ' extends ' . $variableClassName . '
{
	public function __construct(SimpleXMLElement $xml)
	{
		parent::__construct($xml);
		if(!is_numeric($this->value))
			throw new Exception("Value [$this->value] in class [" . get_class($this) . "] is not numeric");
			
		$this->value = floatval($this->value);
	}
}';
		file_put_contents($path . DIRECTORY_SEPARATOR . "$className.php", $class);
		
		
		
		
		$className = $this->prefix . 'Boolean';
		$class = '<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . \'' . $variableClassName . '.php\';

class ' . $className . ' extends ' . $variableClassName . '
{
	public function __construct(SimpleXMLElement $xml)
	{
		parent::__construct($xml);
		
		if($this->value === \'true\')
			$this->value = true;
		elseif($this->value === \'false\')
			$this->value = false;
		else
			$this->value = (bool)$this->value;
	}
}';
		file_put_contents($path . DIRECTORY_SEPARATOR . "$className.php", $class);
	}
	
	protected function writeBaseObject($path)
	{
		$className = $this->prefix . 'Object';
		$class = '<?php
class ' . $className . '
{
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var ' . $className . '
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
	
	public function __construct(SimpleXMLElement $xml, ' . $className . ' $parent = null)
	{
		$this->parent = $parent;
		$this->xml = $xml->asXML();
		$this->xmlName = $xml->getName();
		$namespaces = array_keys($xml->getNamespaces());
		$this->xmlNamespace = reset($namespaces);
		
		$attributes = $xml->attributes();
		$attributeNames = call_user_func(array(get_class($this), \'getAttributes\'));
		foreach ($attributeNames as $attributeName => $type)
		{
			if(isset($attributes->$attributeName))
			{
				$this->$attributeName = $this->getXmlValue($attributes->$attributeName, $type);
			}
		}
	
		$children = $xml->children($this->xmlNamespace, true);
		$childrenNames = call_user_func(array(get_class($this), \'getChildren\'));
		foreach ($children as $child)
		{
			/* @var $child SimpleXMLElement */
			$nodeName = $child->getName();
			if(isset($childrenNames[$nodeName]))
			{
				$type = $childrenNames[$nodeName];
				$nodeName = lcfirst($nodeName);
				$matches = null;
				if(preg_match(\'/^array<([^>]+)>$/\', $type, $matches))
				{
					$type = $matches[1];
					$nodeName .= \'Objects\'; 
					array_push($this->$nodeName, $this->getXmlValue($child, $type));
				}
				else 
				{
					$require = __DIR__ . DIRECTORY_SEPARATOR . $type . \'.php\';
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
		if(preg_match(\'/^array<([^>]+)>$/\', $type, $matches))
		{
			$type = $matches[1];
			$values = explode(\' \', $value);
			foreach($values as &$value)
				$value = $this->getXmlValue($value, $type);
				
			return $values;
		}
		
		switch ($type)
		{
			case \'string\':
				return strval($value);
			case \'int\':
				return intval($value);
			case \'float\':
			case \'double\':
				return floatval($value);
			case \'boolean\':
				return (bool) $value;
			default:
				$require = __DIR__ . DIRECTORY_SEPARATOR . $type . \'.php\';
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
	public function __toXml(SimpleXMLElement &$parentXml = null)
	{
		$nodeName = $this->xmlName;
		if($this->xmlNamespace)
			$nodeName = "$this->xmlNamespace:$this->xmlName";
				
		if(!is_null($parentXml))
		{
			$xml = $parentXml->addChild($nodeName);
		}
		else 
		{				
			$xml = new SimpleXMLElement("<$nodeName/>");
		}
		
		$attributeNames = call_user_func(array(get_class($this), \'getAttributes\'));
		foreach ($attributeNames as $attributeName => $type)
		{
			if(!is_null($this->$attributeName))
			{
				$xml->addAttribute($attributeName, strval($this->$attributeName));
			}
		}
	
		$childrenNames = call_user_func(array(get_class($this), \'getChildren\'));
		foreach ($childrenNames as $childName => $type)
		{
			$method = "get{$childName}";
			if(preg_match(\'/^array<([^>]+)>$/\', $type))
				$method = "get{$childName}Objects";
				
			$value = $this->$method();
			if(is_null($value))
				continue;
				
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
				continue;				
			}
			
			if($value instanceof DashObject)
			{
				$value->__toXml($xml);
				continue;	
			}
			
			$xml->addChild($childName, $value);
		} 
		
		return $xml;
	}
	
	protected static function getAttributes()
	{
		return array(
			\'id\' => \'string\',
		);
	}

	protected static function getChildren()
	{
		return array();
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
	 * @return ' . $className . '
	 */
	public function getParent()
	{
		return $this->parent;
	}
}';
		file_put_contents($path . DIRECTORY_SEPARATOR . "$className.php", $class);
	}
	
	protected function writeType($element, $path, $className)
	{
		if($element instanceof XsdComplexType)
		{
			$this->writeComplexType($element, $path, $className);
		}
		elseif($element instanceof XsdSimpleType)
		{
			$this->writeSimpleType($element, $path, $className);
		}
		else
		{
			throw new Exception("Unable to generate class [$className] of type " . get_class($element));
		}
	}
	
	public function generate($path)
	{
		$this->writeBaseObject($path);
		$this->writeBaseVariable($path);
	
		foreach($this->classes as $className => $element)
		{
			$this->writeType($element, $path, $className);
		}
		
		foreach($this->addedClasses as $className => $element)
		{
			$this->writeType($element, $path, $className);
		}
	}
}