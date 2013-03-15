# Store Maintenance

Store Maintenance allows you to put each store view separately into maintenance mode. It can be configured from backend, so no need to hack any of your files (e.g. index.php) on your server.

## Facts
- - -
 * latest stable version: 0.3.3
 * [extension on Magento Connect](http://www.magentocommerce.com/magento-connect/store-maintenance.html)
 * Magento Connect 1.0 extension key: magento-community/BalkeTechnologies_StoreMaintenance
 * Magento Connect 2.0 extension key: http://connect20.magentocommerce.com/community/BalkeTechnologies_StoreMaintenance
 * [extension on BitBucket](https://bitbucket.org/matthiasbalke/magento-module-storemaintenance)
 * [direct download link](https://bitbucket.org/matthiasbalke/magento-module-storemaintenance/downloads/BalkeTechnologies_StoreMaintenance-0.3.3.tgz)

## Description
- - -
Store Maintenance is developed to give shop developers/administrators an easy way to lock out customers, while they maintain their stores.

## Features
- - -
 * A custom html page can be defined in the backend, which is displayed to all customers, while the store is in maintenance mode.
 * After logging into the backend as an administrator, the frontend can be used with this account. This way updates and changes to the shop / design can be reviewed and tested in a safe manner.
 * IPs can be white listed from within the backend, so chosen accounts can view the store frontend while in maintenance mode, without having to have administrator access.

## Compatibility
- - -
 * Magento >= 1.4

## Installation Instructions
- - -
1. Install the extension via Magento Connect with the key shown above or copy all the files into your document root.
2. Clear the cache, logout from the admin panel and then login again.
3. Configure and activate the extension under System - Balke Technologies - Store Maintenance

## Uninstallation Instructions
- - -
1. Delete the file app/etc/modules/BalkeTechnologies_StoreMaintenance.xml
2. Remove all remaining extension files:
    * app/code/community/BalkeTechnologies/StoreMainenance/
    * app/design/adminhtml/default/default/template/balketechnologies/storemaintenance/
    * app/design/adminhtml/base/default/template/balketechnologies/storemaintenance/
    * skin/frontend/base/default/balketechnologies/storemaintenance/
    * skin/frontend/default/default/balketechnologies/storemaintenance/
3. Execute this SQL to delete module settings from database:  
```
:::sql
DELETE FROM core_config_data WHERE path LIKE 'storeMaintenance%';
```

## Support
- - -
If you have any issues with this extension, open an [issue on BitBucket](https://bitbucket.org/matthiasbalke/magento-module-storemaintenance/issues)

## Contribution
- - -
Any contributions are highly appreciated. The best way to contribute code is to open a
[pull request on BitBucket](https://confluence.atlassian.com/display/BITBUCKET/Working+with+pull+requests).

## Developer
- - -
Matthias Balke
[http://www.balke-technologies.de](http://www.balke-technologies.de)

## License
- - -
[Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0.html)
```
:::text
Copyright since 2011 Matthias Balke (magento@balke-technologies.de)

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
```

## Sponsors
- - -
Developed using a free OpenSource license of [PHP Storm 5](http://www.jetbrains.com/phpstorm/) sponsored by [JetBrains](http://www.jetbrains.com/):

[![PHP Storm 5](http://www.jetbrains.com/img/logos/phpstorm_logo142x29.gif "PHP Storm 5")](http://www.jetbrains.com/phpstorm/)

[![JetBrains](http://www.jetbrains.com/img/logos/logo_jetbrains_small.gif "JetBrains")](http://www.jetbrains.com/)

## Copyright
- - -
(c) since 2011 Matthias Balke (Balke-Technologies.de)