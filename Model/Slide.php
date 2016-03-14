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

/**
 * @method int getSlideId()
 * @method \Scandiweb\Slider\Model\Slider setSlideId(int $value)
 * @method int getSliderId()
 * @method \Scandiweb\Slider\Model\Slider setSliderId(int $value)
 * @method string getTitle()
 * @method \Scandiweb\Slider\Model\Slider setTitle(string $value)
 * @method string getImage()
 * @method \Scandiweb\Slider\Model\Slider setImage(string $value)
 * @method bool getIsActive()
 * @method \Scandiweb\Slider\Model\Slider setIsActive(bool $value)
 * @method int getPosition()
 * @method \Scandiweb\Slider\Model\Slider setPosition(int $value)
 * @method string getStartTime()
 * @method \Scandiweb\Slider\Model\Slider setStartTime(string $value)
 * @method string getEndTime()
 * @method \Scandiweb\Slider\Model\Slider setEndTime(string $value)
 * @method string getSlideLink()
 * @method \Scandiweb\Slider\Model\Slider setSlideLink(string $value)
 * @method string getSlideLinkText()
 * @method \Scandiweb\Slider\Model\Slider setSlideLinkText(string $value)
 * @method int getSlideTextPosition()
 * @method \Scandiweb\Slider\Model\Slider setSlideTextPosition(int $value)
 */
class Slide extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\ResourceModel\Slide');
    }
}