<?php
/**
 * Copyright © Ecomteck LLC. All rights reserved.
 * See COPYING.txt for license details.
 * http://www.ecomteck.com | support@ecomteck.com
 */
namespace Ecomteck\EditOrderEmail\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * Retrieve the config value.
     *
     * @param string $configPath
     * @return mixed
     */
    public function getConfigValue($configPath)
    {
        return $this->scopeConfig->isSetFlag(
            $configPath,
            ScopeInterface::SCOPE_STORE
        );
    }
}
