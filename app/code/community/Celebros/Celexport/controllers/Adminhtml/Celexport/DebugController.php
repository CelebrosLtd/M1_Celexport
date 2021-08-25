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
class Celebros_Celexport_Adminhtml_Celexport_DebugController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/celexport/celexport_crondebug');
    }
    
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('system');
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(TRUE);
        $this->getLayout()->getBlock('head')->setTitle(Mage::helper('celexport')->__('Celebros Export - Cron Debug'));
        $this->_addContent($this->getLayout()->createBlock('celexport/adminhtml_debug_cron_system'));
        $this->_addContent($this->getLayout()->createBlock('celexport/adminhtml_debug_cron_settings'));
        $this->_addContent($this->getLayout()->createBlock('celexport/adminhtml_debug_cron_cron'));
        $this->_addContent($this->getLayout()->createBlock('celexport/adminhtml_debug_cron_tasks'));
        $this->renderLayout();

    }
    
    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function systemcronlogAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function clearhistoryAction()
    {
        Mage::getModel('celexport/cronlog')->truncate();
        if ($this->isFromConfigPage()) {
            $url = $this->getUrl('*/system_config/edit', array('_current' => TRUE, 'section' => 'celexport'));
        } else {
            $url = $this->getUrl('*/*/index', array('_current' => TRUE));
        }
        
        Mage::app()->getResponse()->setRedirect($url);
    }
    
    public function isFromConfigPage()
    {
        return (bool)Mage::app()->getRequest()->getParam('config');
    }
    
}
