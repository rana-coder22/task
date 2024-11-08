<?php

namespace Coding\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Coding\HelloWorld\Model\BlogFactory;

class ShowBlogs extends Action
{
    protected $resultPageFactory;
    protected $blogFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        BlogFactory $blogFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->blogFactory = $blogFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        // Fetching parameters
        $email = $this->getRequest()->getParam('email');
        $startDate = $this->getRequest()->getParam('start_date');
        $endDate = $this->getRequest()->getParam('end_date');

        // Fetch blogs based on filters
        $blogs = $this->fetchBlogs($email, $startDate, $endDate);

        // Assign blogs to the block
        $resultPage->getLayout()->getBlock('email.post')->setBlogs($blogs);

        return $resultPage;
    }

    protected function fetchBlogs($email, $startDate, $endDate)
    {
        $collection = $this->blogFactory->create()->getCollection();

        if ($email) {
            $collection->addFieldToFilter('email', $email);
        }
        if ($startDate) {
            $collection->addFieldToFilter('start_date', ['gteq' => $startDate . ' 00:00:00']);
        }
        if ($endDate) {
            $collection->addFieldToFilter('end_date', ['lteq' => $endDate . ' 23:59:59']);
        }

        return $collection->load();
    }
}
