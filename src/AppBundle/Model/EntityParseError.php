<?php
namespace AppBundle\Model;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EntityParseError {
	protected $isModValid;
	protected $parseException;
	protected $objectinstance;
	function __construct() {
		$this->isModValid=true;
		$this->parseException="";		
	}
	function setObjectInstance($obj) {
		$this->objectinstance=$obj;
	}
	function getObjectInstance() {
		return $this->objectinstance;
	}
	function isValid() {
		return $this->isModValid;
	}
	function getError() {
		return $this->parseException;
	}
	function setError($str) {
		$this->parseException=$str;
		$this->isModValid=false;
	}
	function serializeSendBack() {
		$t['isValid']=$this->isModValid;
		$t['exception']=$this->parseException;
		if ($this->getObjectInstance())
			$t['object']=$this->getSerializedJson($this->getObjectInstance());
		return $t;
	}
	
	protected function getSerializedJson($object) {
		$encoder = new JsonEncode();
		$normalizer = new ObjectNormalizer();
		$normalizer->setCircularReferenceHandler(function ($object) {
			if (method_exists($object, 'getId'))
				return $object->getId();
			else 
				return 'circ_object';
		});
		$serializer = new Serializer(array($normalizer), array($encoder));
		return $serializer->serialize($object, 'json');
	}
	
}