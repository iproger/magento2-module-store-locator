<?php

namespace Iproger\StoreLocator\Controller\Adminhtml\Location;

class Index extends \Iproger\StoreLocator\Controller\Adminhtml\Location
{
    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Store Locations')));

        return $resultPage;
    }
}
