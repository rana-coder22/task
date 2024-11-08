<?php

namespace AdminGrid\Practice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use AdminGrid\Practice\Model\PostFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends Action implements HttpGetActionInterface
{
    protected $postFactory;

    public function __construct(
        Action\Context $context,
        PostFactory $postFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $post = null;

        if ($id) {
            $post = $this->postFactory->create()->load($id);
            if (!$post->getId()) {
                $this->messageManager->addErrorMessage(__('This record no longer exists.'));
                return $this->resultRedirectFactory->create()->setPath('grid/index/index');
            }
        }

        $this->_view->loadLayout();

        // Pass the post data to the block
        $block = $this->_view->getLayout()->getBlock('edit.form');
        if ($block && $post) {
            $block->setPost($post); // Pass the post object to the block
        }

        $this->_view->renderLayout();
    }
}
