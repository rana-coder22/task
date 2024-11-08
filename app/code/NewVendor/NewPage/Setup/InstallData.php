<?php
namespace NewVendor\NewPage\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\UrlRewrite\Model\UrlRewriteFactory;

class InstallData implements InstallDataInterface
{
    private $urlRewriteFactory;

    public function __construct(UrlRewriteFactory $urlRewriteFactory)
    {
        $this->urlRewriteFactory = $urlRewriteFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // Create URL Rewrite
        $urlRewrite = $this->urlRewriteFactory->create();
        $urlRewrite->setData([
            'entity_type' => 'custom',
            'entity_id' => null,
            'request_path' => 'newpage.html',
            'target_path' => 'newpage/index/index',
            'store_id' => 0,
            'redirect_type' => 0,
            'description' => '',
            'is_autogenerated' => 1,
        ]);
        $urlRewrite->save();

        $setup->endSetup();
    }
}