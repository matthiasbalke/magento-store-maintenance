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
class BalkeTechnologies_StoreMaintenance_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * Return the config value for the passed key
     *
     * @param string $key if null or nothing passed current store is used
     * @return string config value
     */
    public function getConfig($key, $section = 'settings', $storeId = null) {
        $path = 'storeMaintenance/' . $section . '/' . $key;
        return Mage::getStoreConfig($path, $storeId);
    }

    /**
     * <p>replace template placeholders</p>
     * <p>available: <strong>{{year}}, {{month}}, {{day}}, {{hours}}, {{minutes}}, {{seconds}}</strong></p>
     * @param String $htmlCode
     * @return String 
     */
    public function replacePlaceholders($htmlCode) {

        $placeHolders = array(
            '{{year}}'    => $this->getConfig('endYear', 'templateSettings'),
            '{{month}}'   => $this->getConfig('endMonth', 'templateSettings'),
            '{{day}}'     => $this->getConfig('endDay', 'templateSettings'),
            '{{hours}}'   => $this->getConfig('endHours', 'templateSettings'),
            '{{minutes}}' => $this->getConfig('endMinutes', 'templateSettings'),
            '{{seconds}}' => $this->getConfig('endSeconds', 'templateSettings'),
            '{{skinBasePath}}'=> Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN) . $this->getConfig('templateSettings/skinBasePath'),
        );
        
        foreach ($placeHolders as $placeHolder => $replacement) {
            $htmlCode = str_replace($placeHolder, $replacement, $htmlCode);
        }
        
        $regexPlaceHolders = array(
            /* 1 = template type
             * 2 = var
             * 3 = comparator
             * 4 = value
             * 5 = content
             */
            '/{{(if)="(.*)(==|!=|<|>)(.*)"}}([^{]*)({{else}}([^{]*))?{{\/if}}/isU'
        );
         
        foreach ($regexPlaceHolders as $placeHolder) {
            $htmlCode = preg_replace_callback($placeHolder, array(&$this, '__templateCallback'), $htmlCode);
        }

        return $htmlCode;
    }
    
    private function __templateCallback($matches) {

        switch ($matches[1]) {
            case 'if':

                $variableName = $matches[2];
                $comparator   = $matches[3];
                $value        = $matches[4]; 
                $content      = $matches[5];
                $elseContent  = '';

                if (6 < count($matches)) {
                    $elseContent = $matches[7];
                }

                $variable = $this->getConfig($variableName, 'templateSettings');
                
                switch ($comparator) {
                    case '==':
                        if ($variable == intval($value)) {
                            return $content;
                        } else {
                            return $elseContent;
                        }
                        break;
                    case '!=':
                        if ($variable != $value) {
                            return $content;
                        } else {
                            return $elseContent;
                        }
                        break;
                    case '<':
                        if ($variable < intval($value)) {
                            return $content;
                        } else {
                            return $elseContent;
                        }
                        break;
                    case '>':
                        if ($variable > intval($value)) {
                            return $content;
                        } else {
                            return $elseContent;
                        }
                        break;

                    default:
                        Mage::throwException(__METHOD__ . ":" . __LINE__ . " unsupported comperator: " . $comparator);
                }
                break;

            default:
                Mage::throwException(__METHOD__ . ":" . __LINE__ . " unsupported template: " . $matches[0]);
                break;
        }
    }

}