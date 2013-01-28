<?php
/**
 *
 *  Copyright since 2011 Matthias Balke (magento@balke-technologies.de)
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */
class BalkeTechnologies_StoreMaintenance_Block_Adminhtml_System_Config_Iparea extends Mage_Adminhtml_Block_System_Config_Form_Field {

    protected function _prepareLayout() {
        parent::_prepareLayout();
        if (!$this->getTemplate()) {
            $this->setTemplate('balketechnologies/storemaintenance/system/config/iparea.phtml');
        }
        return $this;
    }

    public function render(Varien_Data_Form_Element_Abstract $element) {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    public function getHtmlAttributes() {
        return array('title', 'class', 'style', 'onclick', 'onchange', 'rows', 'cols', 'readonly', 'disabled', 'onkeyup', 'tabindex');
    }

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {
        $originalData = $element->getOriginalData();

        $this->addData(array(
            'button_label' => Mage::helper('BalkeTechnologies_StoreMaintenance')->__($originalData['button_label']),
            'html_id' => $element->getHtmlId(),
            'name' => $element->getName(),
            'html_attributes' => $element->serialize($this->getHtmlAttributes()),
            'escaped_value' => $element->getEscapedValue(),
            'after_element_html' => $element->getAfterElementHtml()
        ));
        return $this->_toHtml();
    }

}
