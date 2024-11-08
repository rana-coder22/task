<?php

namespace NewOrder\NewAttribute\Model\ResourceModel\Data\Grid;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('NewOrder\NewAttribute\Model\Data',
            'NewOrder\NewAttribute\Model\ResourceModel\Data');
    }
}
