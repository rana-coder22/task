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


//
//        try {
////            $email = $this->request->getParam('selectedEmail');
////            $startDate = $this->request->getParam('startDate');
////            $endDate = $this->request->getParam('endDate');
////
////            $collection = $this->blogFactory->create()->getCollection();
////
////            if ($email) {
////                $collection->addFieldToFilter('email', $email);
////            }
////            if ($startDate) {
////                $collection->addFieldToFilter('start_date', ['gteq' => $startDate . ' 00:00:00']);
////            }
////            if ($endDate) {
////                $collection->addFieldToFilter('end_date', ['lteq' => $endDate . ' 23:59:59']);
////            }
//
//            // Convert the collection to an array for JSON response
//            $data = $collection->toArray();
////            $block = $resultPage->getLayout()
////                ->createBlock('Coding\HelloWorld\Block\Index\AjaxView')
////                ->setTemplate('Coding_HelloWorld::ajaxview.phtml')
////                ->setData('title',$data)
////                ->toHtml();
////            $resultJson->setData(['result' => $block]);
//            return $data;
//
////            return $resultJson->setData($data);
//
//        } catch (LocalizedException $e) {
//            // Handle specific Magento exceptions
//            return $resultJson->setData(['error' => $e->getMessage()]);
//        } catch (\Exception $e) {
//            // Handle all other exceptions
//            return $resultJson->setData(['error' => __('An error occurred while processing your request.')]);
//        }

}
