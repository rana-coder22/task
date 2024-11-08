<?php
namespace Coding\HelloWorld\Block;

use Magento\Framework\View\Element\Template;
use Coding\HelloWorld\Model\HelloWorldFactory;
use Magento\Framework\Stdlib\DateTime; // Import DateTime class

class BlogView extends Template
{
    protected $blogFactory;
    protected $date; // Declare a property for DateTime

    public function __construct(
        Template\Context $context,
        HelloWorldFactory $blogFactory,
        DateTime $date, // Add DateTime as a parameter
        array $data = []
    ) {
        $this->blogFactory = $blogFactory;
        $this->date = $date; // Assign the DateTime object to the property
        parent::__construct($context, $data);
    }

    public function getBlog()
    {
        $blogId = $this->getRequest()->getParam('id');

        // Get current date in 'Y-m-d' format
        $currentDate = (new \DateTime())->format('Y-m-d H:i:s');
//        dd($currentDate);

        // Load the blog based on ID and filter by end_date (end date should be greater or null)
        $blog = $this->blogFactory->create()->getCollection()
            ->addFieldToFilter('post_id', $blogId)
            ->addFieldToFilter(
                ['end_date'],
                [
//                    ['null' => true], // Show blogs without an end date
                    ['gteq' => $currentDate] // Or end date is greater than or equal to today
                ]
            )
            ->getFirstItem();
//            dd($blog);
        return $blog;
    }
}
