<?php

namespace Iproger\StoreLocator\Controller\Adminhtml\Location;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

class Edit extends \Iproger\StoreLocator\Controller\Adminhtml\Location  implements HttpGetActionInterface
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {
        $model = $this->_objectManager->create(\Iproger\StoreLocator\Model\StoreLocation::class);
        $id = $this->getRequest()->getParam('location_id');
        if ($id) {
            $model->load($id);
        }

        $this->_coreRegistry->register('_current_template', $model);

        $this->_view->loadLayout();
        $this->_setActiveMenu('Iproger_StoreLocator::location_location');

        if ($model->getId()) {
            $breadcrumbTitle = __('Edit Location');
            $breadcrumbLabel = $breadcrumbTitle;
        } else {
            $breadcrumbTitle = __('New Location');
            $breadcrumbLabel = __('Create Location');
        }
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Locations'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            $model->getId() ? $model->getName() : __('New Location')
        );

        $this->_addBreadcrumb($breadcrumbLabel, $breadcrumbTitle);

        $this->_view->renderLayout();
    }
}
