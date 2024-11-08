<?php

namespace AdminGrid\Practice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use AdminGrid\Practice\Model\PostFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save extends Action implements HttpPostActionInterface
{
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
        try {
            $resultRedirect = $this->resultRedirectFactory->create();
            $data = $this->getRequest()->getPostValue();
            $postId = $this->getRequest()->getParam('id');

            if ($postId) {
                $post = $this->postFactory->create();
                $postUpdate = $post->load($postId);
                $postUpdate->setTitle($data['title']);
                $postUpdate->setDescription($data['description']);
                $postUpdate->save();

                }else{

                        // Create a new post instance
                        $post = $this->postFactory->create();

                        // Set data from the form
                        $post->setData($data);

                        // Save the post
                        $post->save();
                        $this->messageManager->addSuccessMessage(__('Record added successfully.'));
                }

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error adding record: ' . $e->getMessage()));
        }
        return $resultRedirect->setPath('grid/index/index');
    }
}
