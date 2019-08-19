<?php

namespace Iproger\StoreLocator\Api;

use Iproger\StoreLocator\Api\Data\StoreLocationInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface StoreLocationRepositoryInterface
{
    /**
     * @param int $id
     * @return \Iproger\StoreLocator\Api\Data\StoreLocationInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Iproger\StoreLocator\Api\Data\StoreLocationInterface $storeLocation
     * @return \Iproger\StoreLocator\Api\Data\StoreLocationInterface
     */
    public function save(StoreLocationInterface $storeLocation);

    /**
     * @param \Iproger\StoreLocator\Api\Data\StoreLocationInterface $storeLocation
     * @return void
     */
    public function delete(StoreLocationInterface $storeLocation);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Iproger\StoreLocator\Api\Data\StoreLocationSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
