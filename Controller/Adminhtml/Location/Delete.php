<?php

namespace Iproger\StoreLocator\Controller\Adminhtml\Location;

use Iproger\StoreLocator\Api\StoreLocationRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Delete extends \Iproger\StoreLocator\Controller\Adminhtml\Location implements HttpPostActionInterface
{
    /**
     * @var StoreLocationRepositoryInterface
     */
    protected $storeLocationRepository;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param StoreLocationRepositoryInterface $storeLocationRepository
     */
    public function __construct(
        Action\Context $context,
        StoreLocationRepositoryInterface $storeLocationRepository
    ) {
        $this->storeLocationRepository = $storeLocationRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $locationId = $this->getRequest()->getParam('location_id');
        if ($locationId) {
            try {
                $storeLocation = $this->storeLocationRepository->getById($locationId);
                $this->storeLocationRepository->delete($storeLocation);
                $this->messageManager->addSuccessMessage(__('You deleted store location.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['location_id' => $locationId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find store location to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
