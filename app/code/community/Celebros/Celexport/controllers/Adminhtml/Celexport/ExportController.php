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
class Celebros_Celexport_Adminhtml_Celexport_ExportController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/celexport');
    }
    
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function export_celebrosAction()
    {
        $model = Mage::getModel('celexport/exporter');
        
        $isWebRun = $this->getRequest()->getParam('webadmin');
        $body = $model->export_celebros($isWebRun);
        $this->getResponse()->setBody($body);
    }
    
    public function export_orders_celebrosAction()
    {
        $model = Mage::getModel('celexport/exporter');
        $body = $model->export_orders_celebros();
        $this->getResponse()->setBody($body);
    }   
    
    public function schedule_exportAction()
    {
        $body = Mage::getModel('celexport/exporter')->scheduleNewExport();
        $this->getResponse()->setBody($body);
    }
    
    public function resetstampAction()
    {
        $store = Mage::app()->getRequest()->getParam('store');
        if ($store) {
            $scope = 'stores';
            $storeId = Mage::app()->getStore($store)->getStoreId();
        } else {
            $scope = 'default';
            $storeId = 0;
        }
        
        Mage::getModel('core/config')->saveConfig(
            'celexport/export_settings/env_stamp', 
            Mage::helper('celexport')->getCurrentEnvStamp(),
            $scope,
            $storeId
        );
        
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