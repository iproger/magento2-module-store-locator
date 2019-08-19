<?php

namespace Iproger\StoreLocator\Controller\Adminhtml\Location;

class NewAction extends \Iproger\StoreLocator\Controller\Adminhtml\Location
{
    const ADMIN_RESOURCE = 'Iproger_StoreLocator::location';

    protected $resultPageFactory;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }

//    public function execute()
//    {
//        return $this->resultPageFactory->create();
//    }
}
