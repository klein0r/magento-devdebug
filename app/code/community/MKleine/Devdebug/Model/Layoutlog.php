<?php
/**
 * MKleine - (c) Matthias Kleine
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@mkleine.de so we can send you a copy immediately.
 *
 * @category    MKleine
 * @package     MKleine_Devdebug
 * @copyright   Copyright (c) 2013 Matthias Kleine (http://mkleine.de)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MKleine_Devdebug_Model_Layoutlog extends Mage_Core_Model_Abstract
{
    const XML_PATH_DEV_LAYOUT_LOGGING = 'dev/log/layoutlogging';

    /**
     * @param $action
     * @param $layout Mage_Core_Model_Layout
     */
    public function log($action, $layout)
    {
        if ($this->isLayoutLoggingAllowed()) {

            $actionName = $action->getFullActionName();
            $xml = $layout->getXmlString();

            $filename = sprintf("layoutlog-%s.log", $actionName);

            $this->writeLog($filename, $xml);
        }
    }

    public function isLayoutLoggingAllowed()
    {
        return Mage::getStoreConfig(self::XML_PATH_DEV_LAYOUT_LOGGING)
            && Mage::helper('core')->isDevAllowed();
    }

    protected function writeLog($file, $message)
    {
        Mage::log($message, Zend_Log::DEBUG, $file);
    }
}