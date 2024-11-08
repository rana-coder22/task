<?php

namespace Coding\HelloWorld\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Coding\HelloWorld\Model\ResourceModel\Blog\CollectionFactory;


class EmailList implements ArrayInterface
{
    protected $_blogCollectionFactory;

    public function __construct(CollectionFactory $blogCollectionFactory)
    {
        $this->_blogCollectionFactory = $blogCollectionFactory;
    }

    public function toOptionArray($isMultiselect = false)
    {
        $emails = $this->_getEmailsFromDatabase();

        $options = [];
        foreach ($emails as $email) {
            $options[] = [
                'value' => $email['email'],
                'label' => $email['email']
            ];
        }

        if (!$isMultiselect) {
            array_unshift($options, ['value' => '', 'label' => __('--Please Select--')]);
        }

        return $options;
    }

    protected function _getEmailsFromDatabase()
    {
      $collection = $this->_blogCollectionFactory->create();

        $collection->addFieldToSelect('email')
            ->distinct(true);  // This ensures distinct emails are returned

        return $collection->getData();  // Return the emails as an array
    }

//    public function getPostLimit() {
//        // Retrieve the value of 'postlimit' from the configuration
//        return $this->scopeConfig->getValue('your_section/your_group/postlimit', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
//    }
}
