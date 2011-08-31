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
class BalkeTechnologies_StoreMaintenance_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * Return the config value for the passed key
     *
     * @param string $key if null or nothing passed current store is used
     * @return string config value
     */
    public function getConfig($key, $storeId = null) {
        $path = 'storeMaintenance/settings/' . $key;
        return Mage::getStoreConfig($path, $storeId);
    }

}