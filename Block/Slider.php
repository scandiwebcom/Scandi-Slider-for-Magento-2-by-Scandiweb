<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block;

use Magento\Framework\View\Element\Template;

class Slider extends \Magento\Framework\View\Element\Template
{
    /**
     * @var string $_template
     */
    protected $_template = 'Scandiweb_Slider::slider.phtml';

    /**
     * @var \Scandiweb\Slider\Model\SliderFactory $_sliderFactory
     */
    protected $_sliderFactory;

    /**
     * @var \Scandiweb\Slider\Model\ResourceModel\Slide\CollectionFactory $_slideCollectionFactory
     */
    protected $_slideCollectionFactory;

    /**
     * @var \Scandiweb\Slider\Model\Slide $_slider
     */
    protected $_slider;

    /**
     * @var \Scandiweb\Slider\Model\ResourceModel\Slide\Collection $_slideCollection
     */
    protected $_slideCollection;

    public function __construct(
        Template\Context $context,
        \Scandiweb\Slider\Model\SliderFactory $sliderFactory,
        \Scandiweb\Slider\Model\ResourceModel\Slide\CollectionFactory $slideCollectionFactory,
        array $data
    )
    {
        $this->_sliderFactory = $sliderFactory;
        $this->_slideCollectionFactory = $slideCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return int
     */
    public function getSliderId()
    {
       return (int) $this->getData('slider_id');
    }

    /**
     * @return \Scandiweb\Slider\Model\Slide|bool
     */
    public function getSlider()
    {
        if (!$this->getSliderId()) {
            return false;
        }

        $slider = $this->_sliderFactory->create();
        $slider->load($this->getSliderId());

        if ($slider->getSliderId()) {
            $this->_slider = $slider;

            return $this->_slider;
        }

        return false;
    }

    /**
     * @return \Scandiweb\Slider\Model\ResourceModel\Slide\Collection
     */
    public function getSlides()
    {
        if (!$this->_slideCollection) {
            $this->_slideCollection = $this->_slideCollectionFactory->create();
            $this->_slideCollection;
        }

        return $this->_slideCollection;
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->getSlider()) {
            return '';
        }

        return parent::_toHtml();
    }
}
