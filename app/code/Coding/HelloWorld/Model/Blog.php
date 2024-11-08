<?php

namespace Coding\HelloWorld\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Blog extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Coding\HelloWorld\Model\ResourceModel\Blog');
    }

    public function getDistinctEmails()
    {
        $connection = $this->getResource()->getConnection();
        $select = $connection->select()
            ->distinct()
            ->from($this->getResource()->getMainTable(), 'email');

        return $connection->fetchCol($select);
    }

    public function getBlogsByEmail($email)
    {
        $connection = $this->getResource()->getConnection();
        $select = $connection->select()
            ->from($this->getResource()->getMainTable())
            ->where('email = ?', $email);

        return $connection->fetchAll($select);
    }
}

