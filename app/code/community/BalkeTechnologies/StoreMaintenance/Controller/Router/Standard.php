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
class BalkeTechnologies_StoreMaintenance_Controller_Router_Standard extends Mage_Core_Controller_Varien_Router_Standard {

    public function match(Zend_Controller_Request_Http $request) {

        $helper = Mage::helper('BalkeTechnologies_StoreMaintenance');
        $storeCode = $request->getStoreCodeFromPath();

        $enabled = $helper->getConfig('enabled', $storeCode);

        // module enabled?
        if (1 == $enabled) {

            $allowedIPsString = $helper->getConfig('allowedIPs', $storeCode);

            // remove spaces from string
            $allowedIPsString = preg_replace('/ /', '', $allowedIPsString);

            $allowedIPs = array();

            if ('' !== trim($allowedIPsString)) {
                $allowedIPs = explode(',', $allowedIPsString);
            }

            $currentIP = $_SERVER['REMOTE_ADDR'];

            $allowFrontendForAdmins = $helper->getConfig('allowFrontendForAdmins', $storeCode);

            $adminIp = null;
            if (1 == $allowFrontendForAdmins) {
                //get the admin session
                Mage::getSingleton('core/session', array('name' => 'adminhtml'));


                //verify if the user is logged in to the backend
                $adminSession = Mage::getSingleton('admin/session');
                if ($adminSession->isLoggedIn()) {
                    //do stuff
                    $adminIp = $adminSession['_session_validator_data']['remote_addr'];
                }
            }

            if ($currentIP === $adminIp) {
                // current user is logged in as admin
                $this->__log('Access granted for admin with IP: ' . $currentIP . ' and store ' . $storeCode, 2, $storeCode);
            } else {
                // current user allowed to access website?
                if (!in_array($currentIP, $allowedIPs)) {
                    $this->__log('Access denied  for IP: ' . $currentIP . ' and store ' . $storeCode, 1, $storeCode);

                    $maintenancePage = trim($helper->getConfig('maintenancePage', $storeCode));
                    // if custom maintenance page is defined in backend, display this one
                    if ('' !== $maintenancePage) {

                        Mage::getSingleton('core/session', array('name' => 'front'));

                        $response = $this->getFront()->getResponse();

                        $response->setHeader('HTTP/1.1', '503 Service Temporarily Unavailable');
                        $response->setHeader('Status', '503 Service Temporarily Unavailable');
                        $response->setHeader('Retry-After', '5000');

                        $response->setBody($maintenancePage);
                        $response->sendHeaders();
                        $response->outputBody();
                    }
                    exit();
                } else {
                    $this->__log('Access granted for IP: ' . $currentIP . ' and store ' . $storeCode, 2, $storeCode);
                }
            }
        }

        return parent::match($request);
    }

    /**
     * logging helper
     * 
     * @param type $string      text to log
     * @param type $zendLevel   Zend_Log logging level
     * @param type $verbosityLevelRequired verbosity (0 = no logging, 1 = only denied requests, 2 = denied and granted requests)
     */
    private function __log($string, $verbosityLevelRequired = 1, $storeCode = null, $zendLevel = Zend_Log::DEBUG) {
        $helper = Mage::helper('BalkeTechnologies_StoreMaintenance');
        $logFile = trim($helper->getConfig('logFile', $storeCode));
        $logVerbosity = trim($helper->getConfig('logVerbosity', $storeCode));

        if ('' === $logFile) {
            $logFile = 'maintenance.log';
        }

        if ($logVerbosity >= $verbosityLevelRequired) {
            Mage::log($string, $zendLevel, $logFile);
        }
    }

}