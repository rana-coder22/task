<?php

namespace AdminGrid\Practice\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\AdminGrid\Practice\Model\ResourceModel\Post::class);
    }
}
