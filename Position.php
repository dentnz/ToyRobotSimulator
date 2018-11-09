<?php
namespace ToyRobotSimulator;

use Exception;

/**
 * Position
 *
 * Maintain an x and y coordinate, with the ability to move north, east, south, west. Allows you to associate a 
 * position with any object... including toy robots! 
 * 
 * @author Karl Lurman <karl.lurman@gmail.com>
 */
class Position
{
    /**
     * X and Y
     */
    protected $x;
    protected $y;

    /**
     * @return int X position
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return int Y position
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param int $x X position to be set
     * @param int $y Y position to be set
     */
    public function setPosition($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Check to see if the position has been initialised via setPosition
     * 
     * @throws Exception Position not initialised
     */
    public function checkPositionInitialised()
    {
        if ($this->x === null || $this->y === null) {
            throw new Exception('Position not initialised');
        }
    }

    /**
     * Move Position North
     */
    public function moveNorth()
    {
        $this->checkPositionInitialised();
        $this->y++;
    }

    /**
     * Move Position East
     */
    public function moveEast()
    {
        $this->checkPositionInitialised();
        $this->x++;
    }

    /**
     * Move Position South
     */
    public function moveSouth()
    {
        $this->checkPositionInitialised();
        $this->y--;
    }

    /**
     * Move Position West
     */
    public function moveWest()
    {
        $this->checkPositionInitialised();
        $this->x--;
    }
}

