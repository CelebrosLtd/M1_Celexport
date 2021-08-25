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
class Celebros_Celexport_Block_Adminhtml_Debug_Cron_Tasks extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('crontasksGrid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(TRUE);
        $this->setUseAjax(TRUE);
        $this->setTemplate('celexport/grid.phtml');
        
        $format = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $date = new Zend_Date(Mage::getModel('core/date')->timestamp());
        /*$to = $date->toString($format);*/
        $date->subDay('3');
        $from = $date->toString($format);
        $this->setDefaultFilter(array(
            'created_at' => array(
                'from'   => $from,
                /*'to'     => $to,*/
                'locale' => Mage::app()->getLocale()->getLocaleCode()
            )
        ));
        
       
    }
    
    protected function _prepareCollection()
    {

        $collection = Mage::getModel('cron/schedule')->getCollection();
        if ($this->isCelebrosOnly()) {
            $collection->addFieldToFilter('job_code','celexport_export');
        }
        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        /*$this->addColumn('schedule_id', array(
            'header' => Mage::helper('celexport')->__('Schedule ID'),
            'width'  => '50px',
            'type'   => 'number',
            'index'  => 'schedule_id',
        ));*/
        
        $this->addColumn('job_code', array(
            'header' => Mage::helper('celexport')->__('Job Code'),
            'index'  => 'job_code'
        ));
        
        $status_options = array(
            Mage_Cron_Model_Schedule::STATUS_PENDING => Mage_Cron_Model_Schedule::STATUS_PENDING,
            Mage_Cron_Model_Schedule::STATUS_RUNNING => Mage_Cron_Model_Schedule::STATUS_RUNNING,
            Mage_Cron_Model_Schedule::STATUS_SUCCESS => Mage_Cron_Model_Schedule::STATUS_SUCCESS,
            Mage_Cron_Model_Schedule::STATUS_MISSED => Mage_Cron_Model_Schedule::STATUS_MISSED,
            Mage_Cron_Model_Schedule::STATUS_ERROR => Mage_Cron_Model_Schedule::STATUS_ERROR,
        );
        
        $this->addColumn('status', array(
            'header'  => Mage::helper('celexport')->__('Status'),
            'index'   => 'status',
            'type'    => 'options',
            'options' => $status_options,
            
        ));
        
        $format = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $this->addColumn('created_at', array(
            'format'      => $format,
            'header'      => Mage::helper('sales')->__('Created At'),
            'index'       => 'created_at',
            'type'        => 'datetime',
            'filter_time' => TRUE
        ));
        
        $this->addColumn('scheduled_at', array(
            'format'      => $format,
            'header'      => Mage::helper('sales')->__('Scheduled At'),
            'index'       => 'scheduled_at',
            'type'        => 'datetime',
            'filter_time' => TRUE
        ));
        
        $this->addColumn('executed_at', array(
            'format'      => $format,
            'header'      => Mage::helper('sales')->__('Executed At'),
            'index'       => 'executed_at',
            'type'        => 'datetime',
            'filter_time' => TRUE
        ));
        
        $this->addColumn('finished_at', array(
            'format'      => $format,
            'header'      => Mage::helper('sales')->__('Finished At'),
            'index'       => 'finished_at',
            'type'        => 'datetime',
            'filter_time' => TRUE
        ));
        
        return parent::_prepareColumns();
    }


    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => TRUE));
    }

    public function getRowUrl($row)
    {
        return FALSE;
    }
    
    public function getGridHeader()
    {
        return Mage::helper('celexport')->__('Magento Cron Tasks');
    }
    
    public function isCelebrosOnly()
    {
        return (bool)Mage::app()->getRequest()->getParam('celebros_only');
    }
}
