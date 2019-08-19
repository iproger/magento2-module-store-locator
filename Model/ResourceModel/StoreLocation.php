<?php

namespace Iproger\StoreLocator\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class StoreLocation extends AbstractDb
{
    protected function _construct() {
        $this->_init('store_location', 'location_id');
    }
}
