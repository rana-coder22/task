<?php
namespace Coding\HelloWorld\Model\ResourceModel\Blog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(
            'Coding\HelloWorld\Model\Blog',
            'Coding\HelloWorld\Model\ResourceModel\Blog'
        );
    }

    public function getEmails()
    {
        $this->addFieldToSelect('email'); // Assuming there's an 'email' field in the table
        return $this->getData(); // Get the data as an array of rows
    }
}
