<?php

class Mayank_Attributelogos_Block_Adminhtml_Attributelogos_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('attributelogos_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('attributelogos')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('attributelogos')->__('Logo Information'),
          'title'     => Mage::helper('attributelogos')->__('Logo Information'),
          'content'   => $this->getLayout()->createBlock('attributelogos/adminhtml_attributelogos_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}