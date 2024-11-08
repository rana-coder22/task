<?php

namespace Coding\HelloWorld\Model\ResourceModel;


use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Blog extends AbstractDb

{
    protected function _construct()

    {
        $this->_init('sample_posts', 'post_id');

    }

}