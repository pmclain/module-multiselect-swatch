<?php

namespace Pmclain\MultiSelectSwatch\Block\Adminhtml\Product\Attribute\Edit;

use Magento\Swatches\Model\Swatch;

class Form extends \Magento\Swatches\Block\Adminhtml\Product\Attribute\Edit\Form
{
    /**
     * @param array $values
     * @return $this
     */
    public function addValues($values)
    {
        if (!is_array($values)) {
            return $this;
        }
        $values = array_merge(
            $values,
            $this->getAdditionalData($values)
        );
        if (isset($values['frontend_input']) && 'multiselect' == $values['frontend_input']
            && isset($values[Swatch::SWATCH_INPUT_TYPE_KEY])
        ) {
            $values['frontend_input'] = 'swatch_multiselect_' . $values[Swatch::SWATCH_INPUT_TYPE_KEY];
        }
        return parent::addValues($values);
    }
}
