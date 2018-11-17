<?php
class Pkdeveloper_Medicine_Model_Mysql4_Medicine extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("medicine/medicine", "entity_id");
    }
}