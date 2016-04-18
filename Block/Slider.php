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
    /* @var string $_template */
    protected $_template = 'Scandiweb_Slider::slider.phtml';

    public function __construct(
        Template\Context $context,
        array $data
    )
    {
        parent::__construct($context, $data);
    }

    /**
     * @return int
     */
    public function getSliderId()
    {
       return (int) $this->getData('slider_id');
    }
}
