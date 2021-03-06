<?php
namespace FACTFinder\Data;

use FACTFinder\Loader as FF;

/**
 * A group of filters within the After Search Navigation (ASN).
 */
class FilterGroup extends \ArrayIterator
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var FilterStyle
     */
    private $style;

    /**
     * @var int
     */
    private $detailedLinkCount;

    /**
     * @var string
     */
    private $unit;

    /**
     * @param Filter[] $filters The Filter objects to add to the group.
     * @param string $refKey
     * @param int $foundRecordsCount Total number of records found for the
     *        search these records are from. This can be greater than
     *        count($records), because $records may just be the records from a
     *        single page, while $foundRecordsCount refers to all records found
     *        by the search.
     */
    public function __construct(
        array $filters = array(),
        $name = '',
        FilterStyle $style = null,
        $detailedLinkCount = 0,
        $unit = ''
    ) {
        parent::__construct($filters);

        $this->name = (string)$name;
        $filterStyleEnum = FF::getClassName('Data\FilterStyle');
        $this->style = $style ?: $filterStyleEnum::Regular();
        $this->detailedLinkCount = (int)$detailedLinkCount;
        $this->unit = (string)$unit;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isRegularStyle()
    {
        $filterStyleEnum = FF::getClassName('Data\FilterStyle');
        return $this->style == $filterStyleEnum::Regular();
    }

    /**
     * @return bool
     */
    public function isSliderStyle()
    {
        $filterStyleEnum = FF::getClassName('Data\FilterStyle');
        return $this->style == $filterStyleEnum::Slider();
    }

    /**
     * @return bool
     */
    public function isTreeStyle()
    {
        $filterStyleEnum = FF::getClassName('Data\FilterStyle');
        return $this->style == $filterStyleEnum::Tree();
    }

    /**
     * @return bool
     */
    public function isMultiSelectStyle()
    {
        $filterStyleEnum = FF::getClassName('Data\FilterStyle');
        return $this->style == $filterStyleEnum::MultiSelect();
    }

    /**
     * @return bool
     */
    public function isColorStyle()
    {
        $filterStyleEnum = FF::getClassName('Data\FilterStyle');
        return $this->style == $filterStyleEnum::Color();
    }

    /**
     * @return int
     */
    public function getDetailedLinkCount()
    {
        return $this->detailedLinkCount;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return bool
     */
    public function hasPreviewImages()
    {
        foreach ($this as $filter)
            if ($filter->hasPreviewImage())
                return true;

        return false;
    }

    /**
     * @return bool
     */
    public function hasSelectedItems()
    {
        foreach ($this as $filter)
            if ($filter->isSelected())
                return true;

        return false;
    }
}
