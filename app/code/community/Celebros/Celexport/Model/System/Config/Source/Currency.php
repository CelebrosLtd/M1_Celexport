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
class Celebros_Celexport_Model_System_Config_Source_Currency
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'base_without', 'label' => Mage::helper('celexport')->__('Base Without Taxes')),
            array('value' => 'base_with', 'label' => Mage::helper('celexport')->__('Base With Taxes')),
            array('value' => 'default_without', 'label' => Mage::helper('celexport')->__('Default Without Taxes')),
            array('value' => 'default_with', 'label'  => Mage::helper('celexport')->__('Default With Taxes'))
        );
    }
}
