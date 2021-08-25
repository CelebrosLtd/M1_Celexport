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
class Celebros_Celexport_Block_Adminhtml_Debug_Cron_Cron extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('systemcronlogGrid');
        $this->setDefaultSort('executed_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(TRUE);
        $this->setUseAjax(TRUE);
        
        $format = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $date = new Zend_Date(Mage::getModel('core/date')->timestamp());
        /*$to = $date->toString($format);*/
        $date->subHour('3');
        $from = $date->toString($format);
        $this->_defaultFilter = array(
            'executed_at' => array(
                'from'   => $from,
                /*'to'     => $to,*/
                'locale' => Mage::app()->getLocale()->getLocaleCode()
            )
        );
    }
    
    protected function _prepareLayout()
    {
        /*$this->setChild('truncate_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('adminhtml')->__('Clear History'),
                    'onclick'   => "if(confirm('" . Mage::helper('celexport')->__('Are you really want to clear history?') . "')) window.location = '" . $this->getClearHistoryUrl() . "'; else return false;",
                    'class'   => 'delete'
                ))
        );*/
        return parent::_prepareLayout();
    }
    
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('celexport/cronlog')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        /*$this->addColumn('id', array(
            'header' => Mage::helper('celexport')->__('ID'),
            'type'   => 'number',
            'index'  => 'id',
        ));*/
        
        $format = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $this->addColumn('executed_at', array(
            'format'      => $format,
            'header'      => Mage::helper('celexport')->__('Executed At'),
            'index'       => 'executed_at',
            'type'        => 'datetime',
            'filter_time' => TRUE
        ));

        $this->addColumn('event', array(
            'header' => Mage::helper('celexport')->__('Event Name'),
            'index'  => 'event'
        ));
        
        return parent::_prepareColumns();
    }

    public function getMainButtonsHtml()
    {
        $html = parent::getMainButtonsHtml();
        return $html . $this->getChildHtml('truncate_button');
    }
    
    public function getGridUrl()
    {
        return $this->getUrl('*/*/systemcronlog', array('_current' => TRUE));
    }

    public function getRowUrl($row)
    {
        return FALSE;
    }
    
    public function getGridHeader()
    {
        return Mage::helper('celexport')->__('Magento Cron Module Executions');
    }

    public function getClearHistoryUrl()
    {
        return $this->getUrl('*/*/clearhistory', array('_current' => TRUE));
    }
}
