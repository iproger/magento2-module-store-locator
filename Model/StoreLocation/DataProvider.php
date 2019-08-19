<?php

namespace Iproger\StoreLocator\Model\StoreLocation;

use Iproger\StoreLocator\Model\ResourceModel\StoreLocation\CollectionFactory;
use Iproger\StoreLocator\Model\StoreLocation;
use Iproger\StoreLocator\Model\ResourceModel\StoreLocation\Collection;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;
    
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $storeLocationCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $storeLocationCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        /** @var StoreLocation $storeLocation */
        foreach ($items as $storeLocation) {
            $this->loadedData[$storeLocation->getId()] = $storeLocation->getData();
        }

        return $this->loadedData;
    }
}
