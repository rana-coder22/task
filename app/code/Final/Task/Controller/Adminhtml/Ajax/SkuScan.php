<?php
namespace Final\Task\Controller\Adminhtml\Ajax;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

class SkuScan extends Action
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

        // Get SKU from request parameters
        $sku = $this->getRequest()->getParam('sku');

        // Create block and pass SKU data
        $block = $this->_view->getLayout()
            ->createBlock("Final\Task\Block\Adminhtml\Dashboard")
            ->setData(['sku' => $sku])
            ->setTemplate("Final_Task::dashboard/orders.phtml");

        // Get the HTML output of the block
        $blockHtml = $block->toHtml();

        // Set the response data to include the block HTML
        $resultJson->setData(['result' => $blockHtml]);

        return $resultJson;
    }
}
