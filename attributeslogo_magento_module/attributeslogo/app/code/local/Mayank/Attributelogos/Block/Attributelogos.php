<?php
class Mayank_Attributelogos_Block_Attributelogos extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getAttributelogos()     
     { 
        if (!$this->hasData('attributelogos')) {
            $this->setData('attributelogos', Mage::registry('attributelogos'));
        }
        return $this->getData('attributelogos');
        
    }
}