<?php

namespace AdminGrid\Practice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\RedirectFactory;
use AdminGrid\Practice\Model\PostFactory;


class Delete extends Action{

    protected $postFactory;
    protected $resultRedirectFactory;

    public function __construct(
        Action\Context $context,
        PostFactory $postFactory,
        RedirectFactory $resultRedirectFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            try {
                $post = $this->postFactory->create()->load($id);
                if ($post->getId()) {
                    $post->delete();
                    $this->messageManager->addSuccessMessage(__('Record deleted successfully.'));
                } else {
                    $this->messageManager->addErrorMessage(__('This record no longer exists.'));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error deleting record: ' . $e->getMessage()));
            }
        }

        return $resultRedirect->setPath('grid/index/index');
    }

}
