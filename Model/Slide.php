<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Model;

class Slide extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\ResourceModel\Slide');
    }
}