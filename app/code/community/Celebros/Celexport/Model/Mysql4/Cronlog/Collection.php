<?php
/**
 * Celebros Qwiser - Magento Extension
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish correct extension functionality.
 * If you wish to customize it, please contact Celebros.
 *
 * @category    Celebros
 * @package     Celebros_Celexport
 */
class Celebros_Celexport_Model_Mysql4_Cronlog_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    
    protected function _construct()
    {
        $this->_init('celexport/cronlog');;
    }
    
} 