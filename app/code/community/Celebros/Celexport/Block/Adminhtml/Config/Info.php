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
class Celebros_Celexport_Block_Adminhtml_Config_Info extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    const MODULE_NAME = 'Celebros_Celexport';
    
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $helper = Mage::helper('celexport');
        $id = $element->getHtmlId();
        /*$envStamp = $helper->getCurrentEnvStamp();*/
        $html = '<tr id="row_' . $id . '">';
        /*$html .= '<td class="label" colspan="1">' . $helper->__('Current Env Stamp') . '</td><td class="value" colspan="4">' . $envStamp . '</td>';
        $html .= '</tr>';
        $html .= '<tr id="row">';*/
        $html .= '<td class="label" colspan="1">' . $helper->__('Module Version') . '</td><td class="value" colspan="4">' . $this->getModuleVersion() . '</td>';
        $html .= '</tr>';
        if ($tmp = $this->getModuleBuild()) {
            $html .= '<tr id="row">';
            $html .= '<td class="label" colspan="1">' . $helper->__('Build') . '</td><td class="value" colspan="4">' . $tmp . '</td>';
            $html .= '</tr>';
        }
        
        if ($tmp = $this->getModuleUpdate()) {
            $html .= '<tr id="row">';
            $html .= '<td class="label" colspan="1">' . $helper->__('Last Update') . '</td><td class="value" colspan="4">' . $tmp . '</td>';
            $html .= '</tr>';
        }
        
        if ($tmp = $this->getModuleDesc()) {
            $html .= '<tr id="row">';
            $html .= '<td class="label" colspan="1">' . $helper->__('Description') . '</td><td class="value" colspan="4">' . $tmp . '</td>';
            $html .= '</tr>';
        }
        
        return $html;
    }
    
    public function getModuleBuild()
    {
        return (string)Mage::getConfig()->getNode('modules/' . self::MODULE_NAME . '/build');
    }
    
    public function getModuleVersion()
    {
        return (string)Mage::getConfig()->getNode('modules/' . self::MODULE_NAME . '/version');
    }
    
    public function getModuleUpdate()
    {
        return (string)Mage::getConfig()->getNode('modules/' . self::MODULE_NAME . '/update');
    }
    
    public function getModuleDesc()
    {
        return (string)Mage::getConfig()->getNode('modules/' . self::MODULE_NAME . '/desc');
    }
    
}