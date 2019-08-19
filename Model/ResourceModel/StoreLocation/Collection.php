<?php

namespace Iproger\StoreLocator\Model\ResourceModel\StoreLocation;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'location_id';

    protected function _construct()
    {
        $this->_init(
            \Iproger\StoreLocator\Model\StoreLocation::class,
            \Iproger\StoreLocator\Model\ResourceModel\StoreLocation::class
        );
    }

//    public function addStoreFilter($storeIds = [], $withDefaultStore = true)
//    {
//        if (!is_array($storeIds)) {
//            $storeIds = [$storeIds];
//        }
//        if ($withDefaultStore && !in_array('0', $storeIds)) {
//            array_unshift($storeIds, 0);
//        }
//        $where = [];
//        foreach ($storeIds as $storeId) {
//            $where[] = $this->_getConditionSql('store_ids', ['finset' => $storeId]);
//        }
//
//        $this->_select->where(implode(' OR ', $where));
//
//        return $this;
//    }
}
