<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'XsdOpenAttrs.php';


class XsdSchema extends XsdOpenAttrs
{
	/**
	 * @var string
	 */
	protected $targetNamespace;
	
	/**
	 * @var string
	 */
	protected $version;
	
	/**
	 * @var XsdFullDerivationSet
	 */
	protected $finalDefault;
	
	/**
	 * @var XsdBlockSet
	 */
	protected $blockDefault;
	
	/**
	 * @var XsdFormChoice
	 */
	protected $attributeFormDefault;
	
	/**
	 * @var XsdFormChoice
	 */
	protected $elementFormDefault;
	
	/**
	 * @var string
	 */
	protected $defaultAttributes;
	
	/**
	 * @var XsdXpathDefaultNamespace
	 */
	protected $xpathDefaultNamespace;
	
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var string
	 */
	protected $lang;
	
	/**
	 * @var array<XsdInclude>
	 */
	protected $includeObjects = array();
	
	/**
	 * @var array<XsdImport>
	 */
	protected $importObjects = array();
	
	/**
	 * @var array<XsdRedefine>
	 */
	protected $redefineObjects = array();
	
	/**
	 * @var array<XsdOverride>
	 */
	protected $overrideObjects = array();
	
	/**
	 * @var array<XsdAnnotation>
	 */
	protected $annotationObjects = array();
	
	/**
	 * @var array<XsdDefaultOpenContent>
	 */
	protected $defaultOpenContentObjects = array();
	
	/**
	 * @var array<XsdTopLevelElement>
	 */
	protected $elementObjects = array();
	
	/**
	 * @var array<XsdTopLevelAttribute>
	 */
	protected $attributeObjects = array();
	
	/**
	 * @var array<XsdNotation>
	 */
	protected $notationObjects = array();
	
	/**
	 * @var array<XsdTopLevelSimpleType>
	 */
	protected $simpleTypeObjects = array();
	
	/**
	 * @var array<XsdTopLevelComplexType>
	 */
	protected $complexTypeObjects = array();
	
	/**
	 * @var array<XsdNamedGroup>
	 */
	protected $groupObjects = array();
	
	/**
	 * @var array<XsdNamedAttributeGroup>
	 */
	protected $attributeGroupObjects = array();
	
	private static $attributes = array(
		'targetNamespace' => 'string',
		'version' => 'string',
		'finalDefault' => 'XsdFullDerivationSet',
		'blockDefault' => 'XsdBlockSet',
		'attributeFormDefault' => 'XsdFormChoice',
		'elementFormDefault' => 'XsdFormChoice',
		'defaultAttributes' => 'string',
		'xpathDefaultNamespace' => 'XsdXpathDefaultNamespace',
		'id' => 'string',
		'lang' => 'string',
	);
	
	private static $children = array(
		'include' => 'array<XsdInclude>',
		'import' => 'array<XsdImport>',
		'redefine' => 'array<XsdRedefine>',
		'override' => 'array<XsdOverride>',
		'annotation' => 'array<XsdAnnotation>',
		'defaultOpenContent' => 'array<XsdDefaultOpenContent>',
		'element' => 'array<XsdTopLevelElement>',
		'attribute' => 'array<XsdTopLevelAttribute>',
		'notation' => 'array<XsdNotation>',
		'simpleType' => 'array<XsdTopLevelSimpleType>',
		'complexType' => 'array<XsdTopLevelComplexType>',
		'group' => 'array<XsdNamedGroup>',
		'attributeGroup' => 'array<XsdNamedAttributeGroup>',
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
	public function getTargetNamespace()
	{
		return $this->targetNamespace;
	}

	/**
	 * @param string $targetNamespace
	 */
	public function setTargetNamespace($targetNamespace)
	{
		$this->targetNamespace = $targetNamespace;
	}
	
	/**
	 * @return string
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * @param string $version
	 */
	public function setVersion($version)
	{
		$this->version = $version;
	}
	
	/**
	 * @return XsdFullDerivationSet
	 */
	public function getFinalDefault()
	{
		return $this->finalDefault;
	}

	/**
	 * @param XsdFullDerivationSet $finalDefault
	 */
	public function setFinalDefault(XsdFullDerivationSet $finalDefault)
	{
		$this->finalDefault = $finalDefault;
	}
	
	/**
	 * @return XsdBlockSet
	 */
	public function getBlockDefault()
	{
		return $this->blockDefault;
	}

	/**
	 * @param XsdBlockSet $blockDefault
	 */
	public function setBlockDefault(XsdBlockSet $blockDefault)
	{
		$this->blockDefault = $blockDefault;
	}
	
	/**
	 * @return XsdFormChoice
	 */
	public function getAttributeFormDefault()
	{
		return $this->attributeFormDefault;
	}

	/**
	 * @param XsdFormChoice $attributeFormDefault
	 */
	public function setAttributeFormDefault(XsdFormChoice $attributeFormDefault)
	{
		$this->attributeFormDefault = $attributeFormDefault;
	}
	
	/**
	 * @return XsdFormChoice
	 */
	public function getElementFormDefault()
	{
		return $this->elementFormDefault;
	}

	/**
	 * @param XsdFormChoice $elementFormDefault
	 */
	public function setElementFormDefault(XsdFormChoice $elementFormDefault)
	{
		$this->elementFormDefault = $elementFormDefault;
	}
	
	/**
	 * @return string
	 */
	public function getDefaultAttributes()
	{
		return $this->defaultAttributes;
	}

	/**
	 * @param string $defaultAttributes
	 */
	public function setDefaultAttributes($defaultAttributes)
	{
		$this->defaultAttributes = $defaultAttributes;
	}
	
	/**
	 * @return XsdXpathDefaultNamespace
	 */
	public function getXpathDefaultNamespace()
	{
		return $this->xpathDefaultNamespace;
	}

	/**
	 * @param XsdXpathDefaultNamespace $xpathDefaultNamespace
	 */
	public function setXpathDefaultNamespace(XsdXpathDefaultNamespace $xpathDefaultNamespace)
	{
		$this->xpathDefaultNamespace = $xpathDefaultNamespace;
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
	 * @return string
	 */
	public function getLang()
	{
		return $this->lang;
	}

	/**
	 * @param string $lang
	 */
	public function setLang($lang)
	{
		$this->lang = $lang;
	}
	
	/**
	 * @return array<XsdInclude>
	 */
	public function getIncludeObjects()
	{
		return $this->includeObjects;
	}

	/**
	 * @param array<XsdInclude> $includeObjects
	 */
	public function setIncludeObjects(array $includeObjects)
	{
		$this->includeObjects = $includeObjects;
	}
	
	/**
	 * @return array<XsdInclude>
	 */
	public function getInclude()
	{
		return reset($this->includeObjects);
	}
	
	/**
	 * @return array<XsdImport>
	 */
	public function getImportObjects()
	{
		return $this->importObjects;
	}

	/**
	 * @param array<XsdImport> $importObjects
	 */
	public function setImportObjects(array $importObjects)
	{
		$this->importObjects = $importObjects;
	}
	
	/**
	 * @return array<XsdImport>
	 */
	public function getImport()
	{
		return reset($this->importObjects);
	}
	
	/**
	 * @return array<XsdRedefine>
	 */
	public function getRedefineObjects()
	{
		return $this->redefineObjects;
	}

	/**
	 * @param array<XsdRedefine> $redefineObjects
	 */
	public function setRedefineObjects(array $redefineObjects)
	{
		$this->redefineObjects = $redefineObjects;
	}
	
	/**
	 * @return array<XsdRedefine>
	 */
	public function getRedefine()
	{
		return reset($this->redefineObjects);
	}
	
	/**
	 * @return array<XsdOverride>
	 */
	public function getOverrideObjects()
	{
		return $this->overrideObjects;
	}

	/**
	 * @param array<XsdOverride> $overrideObjects
	 */
	public function setOverrideObjects(array $overrideObjects)
	{
		$this->overrideObjects = $overrideObjects;
	}
	
	/**
	 * @return array<XsdOverride>
	 */
	public function getOverride()
	{
		return reset($this->overrideObjects);
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
	
	/**
	 * @return array<XsdDefaultOpenContent>
	 */
	public function getDefaultOpenContentObjects()
	{
		return $this->defaultOpenContentObjects;
	}

	/**
	 * @param array<XsdDefaultOpenContent> $defaultOpenContentObjects
	 */
	public function setDefaultOpenContentObjects(array $defaultOpenContentObjects)
	{
		$this->defaultOpenContentObjects = $defaultOpenContentObjects;
	}
	
	/**
	 * @return array<XsdDefaultOpenContent>
	 */
	public function getDefaultOpenContent()
	{
		return reset($this->defaultOpenContentObjects);
	}
	
	/**
	 * @return array<XsdTopLevelElement>
	 */
	public function getElementObjects()
	{
		return $this->elementObjects;
	}

	/**
	 * @param array<XsdTopLevelElement> $elementObjects
	 */
	public function setElementObjects(array $elementObjects)
	{
		$this->elementObjects = $elementObjects;
	}
	
	/**
	 * @return array<XsdTopLevelElement>
	 */
	public function getElement()
	{
		return reset($this->elementObjects);
	}
	
	/**
	 * @return array<XsdTopLevelAttribute>
	 */
	public function getAttributeObjects()
	{
		return $this->attributeObjects;
	}

	/**
	 * @param array<XsdTopLevelAttribute> $attributeObjects
	 */
	public function setAttributeObjects(array $attributeObjects)
	{
		$this->attributeObjects = $attributeObjects;
	}
	
	/**
	 * @return array<XsdTopLevelAttribute>
	 */
	public function getAttribute()
	{
		return reset($this->attributeObjects);
	}
	
	/**
	 * @return array<XsdNotation>
	 */
	public function getNotationObjects()
	{
		return $this->notationObjects;
	}

	/**
	 * @param array<XsdNotation> $notationObjects
	 */
	public function setNotationObjects(array $notationObjects)
	{
		$this->notationObjects = $notationObjects;
	}
	
	/**
	 * @return array<XsdNotation>
	 */
	public function getNotation()
	{
		return reset($this->notationObjects);
	}
	
	/**
	 * @return array<XsdTopLevelSimpleType>
	 */
	public function getSimpleTypeObjects()
	{
		return $this->simpleTypeObjects;
	}

	/**
	 * @param array<XsdTopLevelSimpleType> $simpleTypeObjects
	 */
	public function setSimpleTypeObjects(array $simpleTypeObjects)
	{
		$this->simpleTypeObjects = $simpleTypeObjects;
	}
	
	/**
	 * @return array<XsdTopLevelSimpleType>
	 */
	public function getSimpleType()
	{
		return reset($this->simpleTypeObjects);
	}
	
	/**
	 * @return array<XsdTopLevelComplexType>
	 */
	public function getComplexTypeObjects()
	{
		return $this->complexTypeObjects;
	}

	/**
	 * @param array<XsdTopLevelComplexType> $complexTypeObjects
	 */
	public function setComplexTypeObjects(array $complexTypeObjects)
	{
		$this->complexTypeObjects = $complexTypeObjects;
	}
	
	/**
	 * @return array<XsdTopLevelComplexType>
	 */
	public function getComplexType()
	{
		return reset($this->complexTypeObjects);
	}
	
	/**
	 * @return array<XsdNamedGroup>
	 */
	public function getGroupObjects()
	{
		return $this->groupObjects;
	}

	/**
	 * @param array<XsdNamedGroup> $groupObjects
	 */
	public function setGroupObjects(array $groupObjects)
	{
		$this->groupObjects = $groupObjects;
	}
	
	/**
	 * @return array<XsdNamedGroup>
	 */
	public function getGroup()
	{
		return reset($this->groupObjects);
	}
	
	/**
	 * @return array<XsdNamedAttributeGroup>
	 */
	public function getAttributeGroupObjects()
	{
		return $this->attributeGroupObjects;
	}

	/**
	 * @param array<XsdNamedAttributeGroup> $attributeGroupObjects
	 */
	public function setAttributeGroupObjects(array $attributeGroupObjects)
	{
		$this->attributeGroupObjects = $attributeGroupObjects;
	}
	
	/**
	 * @return array<XsdNamedAttributeGroup>
	 */
	public function getAttributeGroup()
	{
		return reset($this->attributeGroupObjects);
	}
	
}