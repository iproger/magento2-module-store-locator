<?php

namespace Iproger\StoreLocator\Block;

use Iproger\StoreLocator\Api\StoreLocationRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\Information;
use Magento\Store\Model\ScopeInterface;

/**
 * Store Locator block
 */
class StoreLocator extends Template
{
    /**
     * @var Json
     */
    protected $json;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreLocationRepositoryInterface
     */
    protected $storeLocationRepository;

    /**
     * @var \Magento\Directory\Model\RegionFactory
     */
    protected $regionFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    public function __construct(
        Template\Context $context,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        Json $json,
        StoreLocationRepositoryInterface $storeLocationRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        array $data = []
    ) {
        $this->json = $json;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->storeLocationRepository = $storeLocationRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->regionFactory = $regionFactory;
        parent::__construct($context, $data);
    }

    public function getMapApiKey()
    {
        return '';
    }

    public function getStoreAddresses()
    {
        $storeAddresses = [];

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $storeLocations = $this->storeLocationRepository->getList($searchCriteria);

        if ($storeLocations) {
            foreach ($storeLocations->getItems() as $storeLocation) {
                $region = $this->regionFactory->create()->load($storeLocation->getRegionId());

                $storeAddresses[] = [
                    'id' => $storeLocation->getId(),
                    'name' => $storeLocation->getName(),
                    'street1' => $storeLocation->getStreet(),
                    'street2' => '',
                    'city' => $storeLocation->getCity(),
                    'state' => $region->getName(),
                    'zipcode' => $storeLocation->getPostcode(),
                    'lat' => (float)$storeLocation->getLatitude(),
                    'lng' => (float)$storeLocation->getLongitude()
                ];
            }
        }

        //print_r($storeAddresses);exit;

        return $this->json->serialize($storeAddresses);
    }

//    public function getStoreAddresses()
//    {
//        $storeAddresses = [
//            [
//                'id' => 0,
//                'name' => 'Store 1',
//                'street1' => 'Main St',
//                'street2' => '',
//                'city' => 'New York',
//                'state' => 'NY',
//                'zipcode' => '10000',
//                'lat' => 40.760381,
//                'lng' => -73.951480
//            ],
//            [
//                'id' => 1,
//                'name' => 'Store 2',
//                'street1' => 'Second St',
//                'street2' => '',
//                'city' => 'New York',
//                'state' => 'NY',
//                'zipcode' => '10000',
//                'lat' => 40.937889,
//                'lng' => -73.048410
//            ],
//            [
//                'id' => 2,
//                'name' => 'Store 3',
//                'street1' => 'East 3rd Street',
//                'street2' => '',
//                'city' => 'New York',
//                'state' => 'NY',
//                'zipcode' => '10000',
//                'lat' => 40.722671,
//                'lng' => -73.982964
//            ],
//        ];
//
//        return $this->json->serialize($storeAddresses);
//    }

//    public function getStoreAddresses()
//    {
//        $websites = $this->storeManager->getWebsites();
//        $storeAddresses = [];
//
//        foreach ($websites as $website) {
//            $websiteId = $website->getId();
//
//            $storeAddresses[] = [
//                'id' => $websiteId,
//                'name' => 'Store',
//                'street' => $this->getWebsiteConfigValue(Information::XML_PATH_STORE_INFO_STREET_LINE1, $websiteId),
//                'state' => $this->getWebsiteConfigValue(Information::XML_PATH_STORE_INFO_REGION_CODE, $websiteId),
//                'lat' => '',
//                'lng' => ''
//            ];
//        }
//
//        return $storeAddresses;
//    }

//    private function getWebsiteConfigValue($value, $websiteId)
//    {
//        return $this->scopeConfig->getValue(
//            $value,
//            ScopeInterface::SCOPE_WEBSITES,
//            $websiteId
//        );
//    }
}
