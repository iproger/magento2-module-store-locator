<?php

namespace Iproger\StoreLocator\Controller\Adminhtml\Location\Edit;

use Iproger\StoreLocator\Model\StoreLocationRepository;
use Magento\Backend\Block\Widget\Context;
use Iproger\StoreLocator\Api\StoreLocationRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var StoreLocationRepositoryInterface
     */
    protected $storeLocationRepository;

    /**
     * @param Context $context
     * @param StoreLocationRepository $storeLocationRepository
     */
    public function __construct(
        Context $context,
        StoreLocationRepositoryInterface $storeLocationRepository
    ) {
        $this->context = $context;
        $this->storeLocationRepository = $storeLocationRepository;
    }

    /**
     * @return int|null
     */
    public function getLocationId()
    {
        try {
            return $this->storeLocationRepository->getById(
                $this->context->getRequest()->getParam('location_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
