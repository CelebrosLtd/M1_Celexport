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
class Celebros_Celexport_Block_Adminhtml_Debug_Cron_System extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('celexport/form.phtml');
        $this->setDestElementId('edit_form');
        $this->setShowGlobalIcon(false);
        $this->setAlign('left');
    }
    
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $cat_id	= $this->getRequest()->getParam('cat_id');
        $fieldset = $form->addFieldset('code', array('legend' => Mage::helper('celexport')->__('Celebros Cron Settings')));
  
        $fieldset->addField('current_magento_time', 'label', array(
            'label'     => Mage::helper('celexport')->__('Current Magento Time'),
            'class'     => 'validate-code',
            'name'      => 'cat_code',
            'onclick'   => '',
            'onchange'  => '',
            'style'     => '',
            'value'     => Mage::getModel('core/date')->date('H:i:s (Y-m-d)'),
            'disabled'  => TRUE
        ));
        
        $fieldset->addField('celebros_cron_expression', 'label', array(
            'label'     => Mage::helper('celexport')->__('Celebros Cron Expression'),
            'class'     => 'validate-code',
            'name'      => 'cat_code',
            'onclick'   => '',
            'onchange'  => '',
            'style'     => '',
            'value'     => Mage::getStoreConfig('celexport/export_settings/cron_expr'),
            'disabled'  => TRUE
        ));
        
        $fieldset->addField('celebros_cron_enabled', 'label', array(
            'label'     => Mage::helper('celexport')->__('Enable Cron Catalog Update'),
            'class'     => 'validate-code',
            'name'      => 'cat_code',
            'onclick'   => '',
            'onchange'  => '',
            'style'     => '',
            'value'     => Mage::getStoreConfig('celexport/export_settings/cron_enabled')?Mage::helper('celexport')->__('Yes'):Mage::helper('celexport')->__('No'),
            'disabled'  => TRUE
        ));
        
        $form->setFieldNameSuffix('settings');
        $this->setForm($form);
    }
    
}