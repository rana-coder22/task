<?php

namespace Coding\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

class AjaxController extends Action
{

    protected $_resultPageFactory;


    protected $_resultJsonFactory;


    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory
    )
    {
        $this->_resultPageFactory = $resultPageFactory;

        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->_resultJsonFactory->create();
        $resultPage = $this->_resultPageFactory->create();
        $email = $this->getRequest()->getParam('email');
        $block = $resultPage->getLayout()
            ->createBlock('Coding\HelloWorld\Block\Index\AjaxView')
            ->setTemplate('Coding_HelloWorld::ajaxview.phtml')
            ->setData('data',$email)
            ->toHtml();
        $result->setData(['result' => $block]);
        return $result;
    }
}
