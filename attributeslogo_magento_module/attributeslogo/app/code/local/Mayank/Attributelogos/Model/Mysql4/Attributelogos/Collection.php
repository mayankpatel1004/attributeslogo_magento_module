<?php

class Mayank_Attributelogos_Model_Mysql4_Attributelogos_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('attributelogos/attributelogos');
    }
}