<?php

class Mayank_Attributelogos_Model_Mysql4_Attributelogos extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the attributelogos_id refers to the key field in your database table.
        $this->_init('attributelogos/attributelogos', 'attributelogos_id');
    }
}