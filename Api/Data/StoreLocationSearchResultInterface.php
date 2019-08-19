<?php

namespace Iproger\StoreLocator\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface StoreLocationSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return StoreLocationInterface[]
     */
    public function getItems();

    /**
     * @param StoreLocationInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
