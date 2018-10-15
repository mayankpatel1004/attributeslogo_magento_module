<?php
class Mayank_Attributelogos_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/attributelogos?id=15 
    	 *  or
    	 * http://site.com/attributelogos/id/15 	
    	 */
    	/* 
		$attributelogos_id = $this->getRequest()->getParam('id');

  		if($attributelogos_id != null && $attributelogos_id != '')	{
			$attributelogos = Mage::getModel('attributelogos/attributelogos')->load($attributelogos_id)->getData();
		} else {
			$attributelogos = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($attributelogos == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$attributelogosTable = $resource->getTableName('attributelogos');
			
			$select = $read->select()
			   ->from($attributelogosTable,array('attributelogos_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$attributelogos = $read->fetchRow($select);
		}
		Mage::register('attributelogos', $attributelogos);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
	
	public function optionsAction()
	{
		$intAttributeId = $this->getRequest()->getParam('attribute_id');
		$objEavAttribute = Mage::getModel('eav/entity_attribute')->load($intAttributeId);
		$attributes = Mage::getResourceModel('eav/entity_attribute_collection')
			->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
			->addFieldToFilter('attribute_code', $objEavAttribute->getAttributeCode()) // This can be changed to any attribute code
			->load(false);
		 
		$attribute = $attributes->getFirstItem()->setEntity(Mage::getModel('catalog/product')->getResource());		
		$arrOptionValues = $attribute->getSource()->getAllOptions(false);
		$strAttributeOptionValues = '';
		$arrAttributeOptionValues = array();
		foreach($arrOptionValues as $arrSpecValue)
		{
			$arrAttributeOptionValues[] = trim($arrSpecValue['value']).'::'.trim($arrSpecValue['label']);
		}
		$strAttributeOptionValues = implode('#',$arrAttributeOptionValues);
		echo $strAttributeOptionValues;
	}
	
}