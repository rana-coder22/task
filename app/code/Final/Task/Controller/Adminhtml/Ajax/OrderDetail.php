<?php

namespace Final\Task\Controller\Adminhtml\Ajax;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

class OrderDetail extends Action
{
    protected $resultJsonFactory;

    public function __construct(
        Action\Context $context,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute(): ResultInterface
    {
        $resultJson = $this->resultJsonFactory->create();

        // Get 'status' from request parameters
        $status = $this->getRequest()->getParam('status');

        // Create the block and pass 'status' data to it
        $block = $this->_view->getLayout()
            ->createBlock("Final\Task\Block\Adminhtml\OrderDetail")
            ->setTemplate("Final_Task::dashboard/orderdetail.phtml")// Make sure you are using the correct block
            ->setData(['status' => $status]);

        // Render the block to get the HTML output
        $blockHtml = $block->toHtml();

        // Return the HTML as JSON response
        $resultJson->setData(['response' => $blockHtml]);

        return $resultJson;
    }
}
