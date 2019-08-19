<?php

namespace Iproger\StoreLocator\Controller\Adminhtml;

abstract class Location extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Iproger_StoreLocator::location';
}
