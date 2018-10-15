<?php
class Mayank_Attributelogos_Block_Adminhtml_Attributelogos extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_attributelogos';
    $this->_blockGroup = 'attributelogos';
    $this->_headerText = Mage::helper('attributelogos')->__('Attributr Logos Manager');
    $this->_addButtonLabel = Mage::helper('attributelogos')->__('Add Logo');
    parent::__construct();
  }
}