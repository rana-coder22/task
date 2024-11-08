<?php

namespace AdminGrid\Practice\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Initialize collection
     */
    protected function _construct()
    {
        $this->_init(
            \AdminGrid\Practice\Model\Post::class,
            \AdminGrid\Practice\Model\ResourceModel\Post::class
        );
    }
}
