<?php

namespace AdminGrid\Practice\Block;

use Magento\Backend\Block\Template;

class EditForm extends Template
{
    protected $post;

    public function setPost($post)
    {
        $this->post = $post;
    }

    public function getPost()
    {
        return $this->post;
    }
}
