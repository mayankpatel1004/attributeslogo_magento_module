<?php

class Mayank_Attributelogos_Model_Attributelogos extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('attributelogos/attributelogos');
    }
	public function fnGetAttributesGridValues()
	{
		$arrGridManufacturers = array();
		
		$attributes = Mage::getSingleton('eav/config')->getEntityType(Mage_Catalog_Model_Product::ENTITY)->getAttributeCollection();
		$attributes->addStoreLabel(Mage::app()->getStore()->getId());
		$arrManufacrurers = array();
		foreach ($attributes as $attr)
		{
			if($attr->getAttributeCodesByFrontendType('multiselect') || $attr->getAttributeCodesByFrontendType('select'))
			{
				if($attr->getStoreLabel() != "")
				{
					$arrGridManufacturers[$attr->getId()] = $attr->getStoreLabel();
				}	
			}	
		}
		
		
		/*if(count($manufacturers))
		{
			foreach($manufacturers as $key => $arrValue)
			{
				$arrGridManufacturers[$arrValue["value"]] = $arrValue["label"];
			}
		}*/
		return $arrGridManufacturers;
	}
}