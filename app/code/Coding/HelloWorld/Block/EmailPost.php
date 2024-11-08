<?php

namespace Coding\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

class EmailPost extends Template
{
    protected $blogs;

    public function setBlogs($blogs)
    {
        $this->blogs = $blogs;
        return $this;
    }

    public function getBlogs()
    {
        return $this->blogs;
    }
}
