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
class Celebros_Celexport_Block_Adminhtml_Config_Ftpnotice extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    public function checkEnvStamp()
    {
        $store = Mage::app()->getRequest()->getParam('store');
        return !(Mage::helper('celexport')->getFtpEnvStamp($store) == Mage::helper('celexport')->getCurrentEnvStamp());
    }
    
    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $id = $element->getHtmlId();

        //$html = '<td colspan="2" class="label"><label for="'.$id.'">'.$element->getLabel().'</label></td>';
        
        $html = '';
        if ($this->checkEnvStamp()) {
            $html .= '<td colspan="3" class="label"><div class="error-msg" style="padding:10px;background-color:#fff;border:1px solid #ddd;padding-left:40px;">';
            $html .= 'Note: your environment stamp is not identical to the current environmental stamp. Export will not run. ';
            $html .= 'Please make sure your FTP details are updated and reset the environment stamp.';
            /*$html .= '<br>Current Env Stamp: ' . Mage::helper('celexport')->getCurrentEnvStamp();
            $html .= '<br>Stored Env Stamp: ' . Mage::helper('celexport')->getFtpEnvStamp();*/
            $html .= '</div></td>';
        }
        
        return $this->_decorateRowHtml($element, $html);
    }
    
    public function getButtonHtml()
    {
        $dialogMessage = Mage::helper('celexport')->__('Are you really want to clear history?');
        $clearHistoryUrl = $this->getClearHistoryUrl();
        $onclickFunction = "if(confirm('" . $dialogMessage . "')) window.location = '" . $clearHistoryUrl . "'; else return false;";
        $html = '<button style="width:60%;" class="scalable delete" style="" onclick="' . $onclickFunction . '" type="button" title="' . Mage::helper('celexport')->__('Reset Env Stamp') . '">';
        $html .= '<span><span><span>' . Mage::helper('celexport')->__('Reset Env Stamp') . '</span></span></span></button>';
        
        $html .= '<style>#celexport_export_settings_env_stamp{width:30% !important}</style>';
        
        return $html;
    }
    
    public function getClearHistoryUrl()
    {
        return $this->getUrl('*/celexport_debug/clearhistory', array('_current' => TRUE, 'config' => 1));
    }
    
}