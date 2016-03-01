<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Slider;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Scandiweb\Slider\Model\ResourceModel\Slider\Collection $_sliderCollection
     */
    protected $_sliderCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Scandiweb\Slider\Model\ResourceModel\Slider\Collection $sliderCollection,
        array $data = []
    ) {
        $this->_sliderCollection = $sliderCollection;
        parent::__construct($context, $backendHelper, $data);
        $this->setEmptyText(__('No Sliders Found'));
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $this->setCollection($this->_sliderCollection);

        return parent::_prepareCollection();
    }
}
