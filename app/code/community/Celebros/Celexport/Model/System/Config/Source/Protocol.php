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
class Celebros_Celexport_Model_System_Config_Source_Protocol
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'ftp', 'label' => Mage::helper('celexport')->__('FTP')),
            array('value' => 'sftp', 'label'  => Mage::helper('celexport')->__('SFTP')),
        );
    }
    
}