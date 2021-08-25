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
class Celebros_Celexport_Block_Adminhtml_Config_Envstamp extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $id = $element->getHtmlId();

        $html = '<td class="label"><label for="'.$id.'">'.$element->getLabel().'</label></td>';

        //$isDefault = !$this->getRequest()->getParam('website') && !$this->getRequest()->getParam('store');
        $isMultiple = $element->getExtType()==='multiple';

        // replace [value] with [inherit]
        $namePrefix = preg_replace('#\[value\](\[\])?$#', '', $element->getName());

        $options = $element->getValues();

        $addInheritCheckbox = false;
        if ($element->getCanUseWebsiteValue()) {
            $addInheritCheckbox = true;
            $checkboxLabel = Mage::helper('adminhtml')->__('Use Website');
        }
        elseif ($element->getCanUseDefaultValue()) {
            $addInheritCheckbox = true;
            $checkboxLabel = Mage::helper('adminhtml')->__('Use Default');
        }

        if ($addInheritCheckbox) {
            $inherit = $element->getInherit()==1 ? 'checked="checked"' : '';
            if ($inherit) {
                $element->setDisabled(true);
            }
        }

        if ($element->getTooltip()) {
            $html .= '<td class="value with-tooltip">';
            $html .= $this->_getElementHtml($element) . $this->getButtonHtml();
            $html .= '<div class="field-tooltip"><div>' . $element->getTooltip() . '</div></div>';
        } else {
            $html .= '<td class="value">';
            $html .= $this->_getElementHtml($element) . $this->getButtonHtml();
        };
        if ($element->getComment()) {
            $html.= '<p class="note"><span>'.$element->getComment().'</span></p>';
        }
        $html.= '</td>';

        if ($addInheritCheckbox) {

            $defText = $element->getDefaultValue();
            if ($options) {
                $defTextArr = array();
                foreach ($options as $k=>$v) {
                    if ($isMultiple) {
                        if (is_array($v['value']) && in_array($k, $v['value'])) {
                            $defTextArr[] = $v['label'];
                        }
                    } elseif ($v['value']==$defText) {
                        $defTextArr[] = $v['label'];
                        break;
                    }
                }
                $defText = join(', ', $defTextArr);
            }

            // default value
            $html.= '<td class="use-default">';
            $html.= '<input id="' . $id . '_inherit" name="'
                . $namePrefix . '[inherit]" type="checkbox" value="1" class="checkbox config-inherit" '
                . $inherit . ' onclick="toggleValueElements(this, Element.previous(this.parentNode))" /> ';
            $html.= '<label for="' . $id . '_inherit" class="inherit" title="'
                . htmlspecialchars($defText) . '">' . $checkboxLabel . '</label>';
            $html.= '</td>';
        }

        $html.= '<td class="scope-label">';
        if ($element->getScope()) {
            $html .= $element->getScopeLabel();
        }
        $html.= '</td>';
        
        $html.= '<td class="">';
        if ($element->getHint()) {
            $html.= '<div class="hint" >';
            $html.= '<div style="display: none;">' . $element->getHint() . '</div>';
            $html.= '</div>';
        }
        $html.= '</td>';
        
        return $this->_decorateRowHtml($element, $html);
    }
    
    public function getButtonHtml()
    {
        $store = Mage::app()->getRequest()->getParam('store', 0);
        
        $host = Mage::getStoreConfig('celexport/export_settings/ftp_host', $store);
        $user = Mage::getStoreConfig('celexport/export_settings/ftp_user', $store);
        $pass = Mage::getStoreConfig('celexport/export_settings/ftp_password', $store);
        $dialogMessage = Mage::helper('celexport')->__('stamp_dialog_message %s %s %s', $host, $user, $pass);
        
        $clearHistoryUrl = $this->getResetStampUrl();
        $onclickFunction = "if(confirm(stampDialog)) window.location = '" . $clearHistoryUrl . "'; else return false;";
        $html = '<button style="width:50%;" class="scalable delete" style="" onclick="' . $onclickFunction . '" type="button" title="' . Mage::helper('celexport')->__('Reset Env Stamp') . '">';
        $html .= '<span><span><span>' . Mage::helper('celexport')->__('Reset Env Stamp') . '</span></span></span></button>';
        $html .= '<script>var stampDialog = "' . $dialogMessage . '";</script>';
        $html .= '<style>#celexport_export_settings_env_stamp{width:40% !important}</style>';
        
        return $html;
    }
    
    public function getResetStampUrl()
    {
        return $this->getUrl('*/celexport_export/resetstamp', array('_current' => TRUE, 'config' => 1));
    }
    
    
}