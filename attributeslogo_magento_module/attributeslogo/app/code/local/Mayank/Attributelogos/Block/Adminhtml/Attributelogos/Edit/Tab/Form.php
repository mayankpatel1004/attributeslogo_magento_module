<?php

class Mayank_Attributelogos_Block_Adminhtml_Attributelogos_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('attributelogos_form', array('legend'=>Mage::helper('attributelogos')->__('Logo information')));
	  
	  
	  	$attributes = Mage::getSingleton('eav/config')->getEntityType(Mage_Catalog_Model_Product::ENTITY)->getAttributeCollection();
		$attributes->addStoreLabel(Mage::app()->getStore()->getId());
		$arrAttributes = array();
		foreach ($attributes as $attr)
		{
			if($attr->getAttributeCodesByFrontendType('multiselect') || $attr->getAttributeCodesByFrontendType('select'))
			{
				if($attr->getStoreLabel() != "")
				{
					$arrAttributes[] = array('value' => $attr->getId(),'label' => $attr->getStoreLabel());
				}
			}
		}
	 
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('attributelogos')->__('Logo Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
	  
	  $fieldset->addField('attribute_id', 'select', array(
		  'label'     => Mage::helper('attributelogos')->__('Attribute'),
		  'name'      => 'attribute_id',
		  'values'    => $arrAttributes,
	  ));
	  
	   $fieldset->addField('option_id', 'select', array(
		  'label'     => Mage::helper('attributelogos')->__('Option'),
		  'name'      => 'option_id'
	  ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('attributelogos')->__('Attribute Logo'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('attributelogos')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('attributelogos')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('attributelogos')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('attributelogos')->__('Content'),
          'title'     => Mage::helper('attributelogos')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getAttributelogosData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getAttributelogosData());
          Mage::getSingleton('adminhtml/session')->setAttributelogosData(null);
      } elseif ( Mage::registry('attributelogos_data') ) {
          $form->setValues(Mage::registry('attributelogos_data')->getData());
      }
      return parent::_prepareForm();
  }
}