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
class Celebros_Celexport_Model_Cronlog extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('celexport/cronlog');
    }
    
    public function addNewTask($event, $time = NULL)
    {
        if (!$time) {
            $data['executed_at'] = date('Y-m-d H:i:s');
        } else {
            $data['executed_at'] = $time;
        }
        
        $data['event'] = $event;
        try {
            $this->setData($data)->save();
        } catch (Exception $e) {
            return FALSE;
        }
        
        $this->cleanUpCollection($this->getCronlogLifetime());
    }
    
    public function truncate()
    {
        $tableName = $this->getCollection()->getResource()->getMainTable();
        $conn = $this->getCollection()->getConnection();
        $conn->truncateTable($tableName);    
    }
    
    public function cleanUpCollection($days)
    {
        $collection = $this->getCollection();
        $date = new Zend_Date(Mage::getModel('core/date')->timestamp());
        $date->subHour((int)$days);
        $borderDate = $date->toString('Y-M-d H:m:s'); 
        $collection->addFieldToFilter('executed_at', array('lt' => $borderDate));
        foreach ($collection as $item) {
            $item->delete();
        }
    }
    
    public function getCronlogLifetime()
    {
        return (int)Mage::getStoreConfig('celexport/advanced/cronlog_lifetime');
    }
} 