<?php

namespace Iproger\StoreLocator\Controller\Adminhtml\Location;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Iproger\StoreLocator\Model\StoreLocation;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Save Store Location action.
 */
class Save extends \Iproger\StoreLocator\Controller\Adminhtml\Location implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Iproger_StoreLocator::save';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Iproger\StoreLocator\Model\StoreLocationFactory
     */
    private $storeLocationFactory;

    /**
     * @var \Iproger\StoreLocator\Api\StoreLocationRepositoryInterface
     */
    private $storeLocationRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \Iproger\StoreLocator\Model\StoreLocationFactory|null $storeLocationFactory
     * @param \Iproger\StoreLocator\Api\StoreLocationRepositoryInterface|null $storeLocationRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Iproger\StoreLocator\Model\StoreLocationFactory $storeLocationFactory,
        \Iproger\StoreLocator\Api\StoreLocationRepositoryInterface $storeLocationRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->storeLocationFactory = $storeLocationFactory;
        $this->storeLocationRepository = $storeLocationRepository;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (empty($data['location_id'])) {
                $data['location_id'] = null;
            }

            /** @var \Iproger\StoreLocator\Model\StoreLocation $model */
            $model = $this->storeLocationFactory->create();

            $id = $this->getRequest()->getParam('location_id');

            if ($id) {
                try {
                    $model = $this->storeLocationRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This store location no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

//            if (!$this->dataProcessor->validate($data)) {
//                return $resultRedirect->setPath('*/*/edit', ['location_id' => $model->getId(), '_current' => true]);
//            }

            try {
                $this->storeLocationRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the store location.'));
                return $this->processResultRedirect($model, $resultRedirect, $data);
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the store location.'));
            }

            $this->dataPersistor->set('store_location', $data);
            return $resultRedirect->setPath('*/*/edit', ['location_id' => $this->getRequest()->getParam('location_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process result redirect
     *
     * @param \Iproger\StoreLocator\Api\Data\StoreLocationInterface $model
     * @param \Magento\Backend\Model\View\Result\Redirect $resultRedirect
     * @param array $data
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws LocalizedException
     */
    private function processResultRedirect($model, $resultRedirect, $data)
    {
        //$this->dataPersistor->clear('store_location');
        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath('*/*/edit', ['location_id' => $model->getId(), '_current' => true]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
