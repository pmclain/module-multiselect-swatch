<?php

namespace Pmclain\MultiSelectSwatch\Observer;

use Magento\Framework\Module\Manager;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddMultiSelectSwatchType implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @param Manager $moduleManager
     */
    public function __construct(Manager $moduleManager)
    {
        $this->moduleManager = $moduleManager;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(EventObserver $observer)
    {
        if (!$this->moduleManager->isOutputEnabled('Pmclain_MultiSelectSwatch')) {
            return;
        }

        /** @var \Magento\Framework\DataObject $response */
        $response = $observer->getEvent()->getResponse();
        $types = $response->getTypes();
        $types[] = [
            'value' => \Pmclain\MultiSelectSwatch\Model\Swatch::SWATCH_MULTISELECT_TYPE_VISUAL_ATTRIBUTE_FRONTEND_INPUT,
            'label' => __('Visual Swatch - Multiselect'),
            'hide_fields' => [
                'is_unique',
                'is_required',
                'frontend_class',
                '_scope',
                '_default_value',
            ],
        ];
        $types[] = [
            'value' => \Pmclain\MultiSelectSwatch\Model\Swatch::SWATCH_MULTISELECT_TYPE_TEXTUAL_ATTRIBUTE_FRONTEND_INPUT,
            'label' => __('Text Swatch - Multiselect'),
            'hide_fields' => [
                'is_unique',
                'is_required',
                'frontend_class',
                '_scope',
                '_default_value',
            ],
        ];

        $response->setTypes($types);
    }
}
