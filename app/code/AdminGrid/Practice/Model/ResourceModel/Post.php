<?php

namespace AdminGrid\Practice\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('block_admin_grid', 'entity_id');
    }
}
