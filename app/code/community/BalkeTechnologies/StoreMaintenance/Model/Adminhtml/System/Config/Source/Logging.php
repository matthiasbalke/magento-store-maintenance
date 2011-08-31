<?php

/**
 *
 *  Copyright 2011 Matthias Balke (mail@balke-technologies.de)
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
class BalkeTechnologies_StoreMaintenance_Model_Adminhtml_System_Config_Source_Logging {

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray() {
        return array(
            array('value' => 0, 'label' => Mage::helper('BalkeTechnologies_StoreMaintenance')->__('no logging')),
            array('value' => 1, 'label' => Mage::helper('BalkeTechnologies_StoreMaintenance')->__('log only denied access')),
            array('value' => 2, 'label' => Mage::helper('BalkeTechnologies_StoreMaintenance')->__('log all access')),
        );
    }

}
