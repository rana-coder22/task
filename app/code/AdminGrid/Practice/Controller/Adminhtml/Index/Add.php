<?php

namespace AdminGrid\Practice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Add extends Action
{
    protected $resultPageFactory;

    public function __construct(Action\Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('AdminGrid_Practice::myadmingrid');
        $resultPage->getConfig()->getTitle()->prepend(__('Add New Record'));

        // Ensure the form block is added to the layout
        $resultPage->getLayout()->addBlock('AdminGrid\Practice\Block\Adminhtml\MyGrid\Form', 'form_block');

        return $resultPage;
    }
}
