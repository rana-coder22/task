<?php

namespace AdminGrid\Practice\Block;

use Magento\Backend\Block\Template;
use AdminGrid\Practice\Model\PostFactory;

class Post extends Template
{
    protected $postFactory;

    public function __construct(
        Template\Context $context,
        PostFactory      $postFactory,
        array            $data = []
    )
    {
        $this->postFactory = $postFactory;
        parent::__construct($context, $data);
    }

    public function getPost()
    {
        // Get the post ID from the request
        $postId = $this->getRequest()->getParam('id');

        // Load the post if the ID exists
        if ($postId) {
            return $this->postFactory->create()->load($postId);
        }

        return null; // Return null if no ID is found
    }
}
