<?php
namespace ToyRobotSimulator;

use Exception;

/**
 * Tabletop
 *
 * Used to represent a rectangular/square tabletop with width and height in grid units. Has the ability to detect grid 
 * coordinates are within bounds.
 *
 * @author Karl Lurman <karl.lurman@gmail.com>
 */
class Tabletop
{
    /**
     * @var int $width Width of the tabletop
     */
    protected $width;
    
    /**
     * @var int $height Height of the tabletop
     */
    protected $height;

    /**
     * @param int $width Width of tabletop in grid units, starting from left
     * @param int $height Height of tabletop in grid units, starting from the bottom
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return int Tabletop width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int Tabletop height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Check if x, y coordinates are within bounds of the tabletop
     *
     * @throws Exception Out of bounds
     */
    public function checkInBounds($x, $y)
    {
        if ($x < 0 || $y < 0 || $x > $this->getWidth() || $y > $this->getHeight()) {
            throw new Exception('Out of bounds');
        }

        return true;
    }
}
