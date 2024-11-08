<?php

namespace NewOrder\NewAttribute\Model;

use Magento\Framework\Model\AbstractModel;

class Data extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NewOrder\NewAttribute\Model\ResourceModel\Data::class);
    }
}
