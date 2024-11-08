<?php

namespace HammadIdrees\HelloWorld\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class RestrictedCountries extends AbstractSource
{
    /**
     * Get all options for the 'restricted_countries' attribute
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('USA'), 'value' => 'USA'],
                ['label' => __('Canada'), 'value' => 'Canada'],
                ['label' => __('UK'), 'value' => 'UK'],
                ['label' => __('Germany'), 'value' => 'Germany'],
                ['label' => __('France'), 'value' => 'France'],
                ['label' => __('Australia'), 'value' => 'Australia'],
                ['label' => __('India'), 'value' => 'India'],
                ['label' => __('Japan'), 'value' => 'Japan'],
                ['label' => __('Italy'), 'value' => 'Italy'],
                ['label' => __('Brazil'), 'value' => 'Brazil'],
                ['label' => __('Spain'), 'value' => 'Spain'],   // New Option
                ['label' => __('Russia'), 'value' => 'Russia'], // New Option
                ['label' => __('Pakistan'), 'value' => 'Pakistan'], // New Option
                ['label' => __('China'), 'value' => 'China'],
                ['label' => __('Indonesia'), 'value' => 'Indonesia'],

            ];
        }
        return $this->_options;
    }
}
