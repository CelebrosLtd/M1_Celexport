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
class Celebros_Celexport_Block_Adminhtml_Debug_Cron_Settings extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('celexport/form.phtml');
        $this->setDestElementId('edit_form');
        $this->setShowGlobalIcon(false);
        $this->setAlign('right');
    }
    
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $cat_id	= $this->getRequest()->getParam('cat_id');
        $fieldset = $form->addFieldset('code', array('legend' => Mage::helper('celexport')->__('Magento Cron Settings')));

        $fieldset->addField('generate_schedules_every', 'label', array(
            'label'     => Mage::helper('celexport')->__('Generate Schedules Every'),
            'class'     => 'validate-code',
            'name'      => 'cat_code',
            'onclick'   => '',
            'onchange'  => '',
            'style'     => '',
            'value'     => Mage::getStoreConfig('system/cron/schedule_generate_every'),
            'disabled'  => TRUE,
            'tabindex'  => 1,
            'width'    => '50px'
        ));

        $fieldset->addField('schedule_ahead_for', 'label', array(
            'label'     => Mage::helper('celexport')->__('Schedule Ahead For'),
            'class'     => 'validate-code',
            'name'      => 'cat_code',
            'onclick'   => '',
            'onchange'  => '',
            'style'     => '',
            'value'     => Mage::getStoreConfig('system/cron/schedule_ahead_for'),
            'disabled'  => TRUE,
            'tabindex'  => 1,
            'width'    => '50px'
        ));
        
        $fieldset->addField('schedule_lifetime', 'label', array(
            'label'     => Mage::helper('celexport')->__('Missed if Not Run Within'),
            'class'     => 'validate-code',
            'name'      => 'cat_code',
            'onclick'   => '',
            'onchange'  => '',
            'style'     => '',
            'value'     => Mage::getStoreConfig('system/cron/schedule_lifetime'),
            'disabled'  => TRUE,
            'tabindex'  => 1,
            'width'    => '50px'
        ));
            
        /*$fieldset->addField('history_cleanup_every', 'label', array(
            'label'     => Mage::helper('celexport')->__('History Cleanup Every '),
            'class'     => 'validate-code',
            'name'      => 'cat_code',
            'onclick'   => '',
            'onchange'  => '',
            'style'     => '',
            'value'     => Mage::getStoreConfig('system/cron/history_cleanup_every'),
            'disabled'  => TRUE,
            'tabindex'  => 1,
            'width'    => '50px'
        ));            
        
        $fieldset->addField('history_success_lifetime', 'label', array(
            'label'     => Mage::helper('celexport')->__('Success History Lifetime'),
            'class'     => 'validate-code',
            'name'      => 'cat_code',
            'onclick'   => '',
            'onchange'  => '',
            'style'     => '',
            'value'     => Mage::getStoreConfig('system/cron/history_success_lifetime'),
            'disabled'  => TRUE,
            'tabindex'  => 1,
            'width'    => '50px'
        ));  
        
        
        $fieldset->addField('history_failure_lifetime', 'label', array(
            'label'     => Mage::helper('celexport')->__('Failure History Lifetime'),
            'class'     => 'validate-code',
            'name'      => 'cat_code',
            'onclick'   => '',
            'onchange'  => '',
            'style'     => '',
            'value'     => Mage::getStoreConfig('system/cron/history_failure_lifetime'),
            'disabled'  => TRUE,
            'tabindex'  => 1,
            'width'    => '50px'
        ));*/  
        
        $form->setFieldNameSuffix('settings');
        $this->setForm($form);
    }
    
}