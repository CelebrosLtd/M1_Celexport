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
class Celebros_Celexport_Model_Observer
{
    public function test($observer)
    {
        $model = Mage::getModel('celexport/cronlog');
        $model->addNewTask($observer->getEvent()->getName());
    }
    
    public function rewriteMenuBlock(Varien_Event_Observer $observer)
    {
        $moduleOutputEnabled = Mage::helper('core')->isModuleOutputEnabled('Celebros_Celexport');
        if ($moduleOutputEnabled) {
            Mage::getConfig()->setNode(
                'global/blocks/adminhtml/rewrite/page_menu',
                'Celebros_Celexport_Block_Adminhtml_Page_Menu'
            );
        }

    }
}