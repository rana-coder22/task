<?php
namespace HammadIdrees\HelloWorld\Block\Product\View;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Registry;
use Magento\Eav\Model\Config as EavConfig;
use function RectorPrefix202308\execCmd;

class Attribute extends Template
{
    protected $_product;
    protected $_registry;
    protected $_eavConfig;
    private \Magento\Catalog\Model\Product $product;

    public function __construct(
        Template\Context $context,
        ProductFactory $productFactory,
        Registry $registry, // Inject Registry class
        EavConfig $eavConfig, // Inject EAV config for attribute label
        \Magento\Catalog\Model\Product $product,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_productFactory = $productFactory;
        $this->_registry = $registry; // Assign Registry instance
        $this->_eavConfig = $eavConfig; // Assign EAV Config instance
        $this->product = $product;
    }

    public function getRestrictedCountries()
    {
//        die('dfsf');
        $product = $this->getProduct();
        $productLoaded = $this->product->load($product->getId());
        $attributeValue =  $productLoaded->getCustomAttribute('restricted_countries');
        $attribute = $this->_eavConfig->getAttribute('catalog_product', 'restricted_countries');

//        $optionLabel = $attribute->getSource()->getOptionText($attributeValue);

//            echo $optionLabel;
//            exit();
        // Get the product
//        print_r($product);
//        exit();
//        echo '<pre>';
//        print_r($product);
//        echo '</pre>';
//        exit();
        if ($product && $product->getData('restricted_countries')) {
//            echo 'here1';
            // Get the select attribute option ID
            $optionId = $product->getData('restricted_countries');

            // Load attribute information for restricted_countries
            $attribute = $this->_eavConfig->getAttribute('catalog_product', 'restricted_countries');

            if ($attribute && $attribute->usesSource()) {
//                echo 'here3';

                // Retrieve the option label using the source model
                $optionLabel = $attribute->getSource()->getOptionText($optionId);
//                print($optionLabel);
//                exit();
                return $optionLabel;
            }
        }
//        else{
//            echo 'here2';
//
//        }

        return '';
    }

    public function getProduct()
    {
        if (!$this->_product) {
            // Fetch current product from the registry
            $this->_product = $this->_registry->registry('current_product');
        }
        return $this->_product;
    }
}
