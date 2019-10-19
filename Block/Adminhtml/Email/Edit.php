<?php
/**
 * Copyright © Ecomteck LLC. All rights reserved.
 * See COPYING.txt for license details.
 * http://www.ecomteck.com | support@ecomteck.com
 */

namespace Ecomteck\EditOrderEmail\Block\Adminhtml\Email;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\Registry;
use Magento\Sales\Api\Data\OrderInterface;
use Ecomteck\EditOrderEmail\Helper\Data;

/**
 * Class Edit
 * @package Ecomteck\EditOrderEmail\Block\Adminhtml\Email
 */
class Edit extends Template
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry = null;

    /**
     * Ecomteck Helper
     *
     * @var Data
     */
    protected $_helper;

    /**
     * @var Context $context
     * @var Registry $coreRegistry
     * @var AuthorizationInterface
     * @var Data $helper
     */
    protected $authorization;

    /**
     * Edit constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param AuthorizationInterface $authorization
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        AuthorizationInterface $authorization,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->coreRegistry = $coreRegistry;
        $this->authorization = $authorization;
        $this->_helper = $helper;
    }

    /**
     * @return string
     */
    public function getAdminPostUrl()
    {
        return $this->getUrl('editorderemail/edit/index');
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->getRequest()->getParam('order_id');
    }

    public function getOrder()
    {
        return $this->coreRegistry->registry('sales_order');
    }

    /**
     * @return int
     */
    public function getAutocheckEmail()
    {
        return $this->_helper->getConfigValue('ecomteck_editorderemail/general/update_customer_email');
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        /** @var OrderInterface $order */
        if ($order = $this->getOrder()) {
            return $order->getCustomerEmail();
        }

        return '';
    }

    /**
     * @return bool
     */
    public function hasCustomerId()
    {
        /** @var OrderInterface $order */
        if ($order = $this->getOrder()) {
            return $order->getCustomerId() ? true : false;
        }

        return false;
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->_authorization->isAllowed('Ecomteck_EditOrderEmail::ecomteck_editorderemail')) {
            return '';
        }

        return parent::_toHtml();
    }
}
