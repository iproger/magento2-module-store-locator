<?php

namespace Iproger\StoreLocator\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Iproger\StoreLocator\Api\Data\StoreLocationInterface;
use Iproger\StoreLocator\Api\Data\StoreLocationSearchResultInterface;
use Iproger\StoreLocator\Api\Data\StoreLocationSearchResultInterfaceFactory;
use Iproger\StoreLocator\Api\StoreLocationRepositoryInterface;
use Iproger\StoreLocator\Model\ResourceModel\StoreLocation\CollectionFactory as StoreLocationCollectionFactory;
use Iproger\StoreLocator\Model\ResourceModel\StoreLocation\Collection;

class StoreLocationRepository implements StoreLocationRepositoryInterface
{
    /**
     * @var StoreLocationFactory
     */
    private $storeLocationFactory;

    /**
     * @var StoreLocationCollectionFactory
     */
    private $storeLocationCollectionFactory;

    /**
     * @var StoreLocationSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    public function __construct(
        StoreLocationFactory $storeLocationFactory,
        StoreLocationCollectionFactory $storeLocationCollectionFactory,
        StoreLocationSearchResultInterfaceFactory $storeLocationSearchResultInterfaceFactory
    ) {
        $this->storeLocationFactory = $storeLocationFactory;
        $this->storeLocationCollectionFactory = $storeLocationCollectionFactory;
        $this->searchResultFactory = $storeLocationSearchResultInterfaceFactory;
    }

    public function getById($id)
    {
        $storeLocation = $this->storeLocationFactory->create();
        $storeLocation->getResource()->load($storeLocation, $id);
        if (! $storeLocation->getId()) {
            throw new NoSuchEntityException(__('Unable to find store location with ID "%1"', $id));
        }
        return $storeLocation;
    }

    public function save(StoreLocationInterface $storeLocation)
    {
        $storeLocation->getResource()->save($storeLocation);
        return $storeLocation;
    }

    public function delete(StoreLocationInterface $storeLocation)
    {
        $storeLocation->getResource()->delete($storeLocation);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->storeLocationCollectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
