<?php

namespace Coding\HelloWorld\Controller\Ajax;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Action\Action;
use Coding\HelloWorld\Model\BlogFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
class Index extends Action
{
    protected $resultJsonFactory;
    protected $resultPageFactory;
    protected $request;
    protected $blogFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        BlogFactory $blogFactory,
        \Magento\Framework\App\Request\Http $request
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->blogFactory = $blogFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        parent::__construct($context);
    }

    public function pagination()
    {

    }
    public function execute()
    {
        $resultJson = $this->_resultJsonFactory->create();
        $resultPage = $this->_resultPageFactory->create();

        $email = $this->getRequest()->getParam('selectedEmail');
        $startDate = $this->getRequest()->getParam('startDate');
        $endDate = $this->getRequest()->getParam('endDate');
        $currentPage = (int)$this->getRequest()->getParam('page', 1); // Get current page number

        // Create block and set parameters
        $block = $resultPage->getLayout()
            ->createBlock('Coding\HelloWorld\Block\Index\AjaxView')
            ->setTemplate('Coding_HelloWorld::ajaxview.phtml')
            ->setData([
                'email' => $email,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'currentPage' => $currentPage // Pass the current page to the block
            ])
            ->toHtml();

        $resultJson->setData(['result' => $block]);
        return $resultJson;
    }

}
