<?php
namespace Coding\HelloWorld\Controller\View;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Coding\HelloWorld\Model\HelloWorldFactory;

class Index extends Action
{
    protected $blogFactory;

    public function __construct(
        Context $context,
        HelloWorldFactory $blogFactory
    ) {
        $this->blogFactory = $blogFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');
        $blog = $this->blogFactory->create()->load($blogId);

        if ($blog->getId()) {
            $this->_view->loadLayout();
            $this->_view->getLayout()->getBlock('blog.view');
            $this->_view->renderLayout();
        } else {
            $this->_redirect('blogstitle/view/index');
        }
    }
}
