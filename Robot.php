<?php
namespace ToyRobotSimulator;

use Exception;

require_once('CanFaceDirection.php');
require_once('CanMovePosition.php');

/**
 * Toy Robot
 *
 * A robot that can be placed into position, turned to face left and right, and moved in it's facing direction.
 * 
 * @author Karl Lurman <karl.lurman@gmail.com>
 */
class Robot
{
    use CanFaceDirection, CanMovePosition { getNextPosition as public traitGetNextPosition; }

    /**
     * Place the robot into a position with direction
     *
     * @param int $x X position
     * @param int $y Y position
     * @param string $direction e.g NORTH
     */
    public function place($x, $y, $direction)
    {
        $this->face($direction);
        $this->placePosition($x, $y);
    }

    /**
     * Move the robot
     */
    public function move()
    {
        $this->movePosition($this->getPosition(), $this->getCurrentDirection());
    }

    /**
     * Turn the robot to face left
     */
    public function left()
    {
        // From CanFaceDirection trait
        $this->turnLeft();
    }

    /**
     * Turn the robot to face right
     */
    public function right()
    {
        // From CanFaceDirection trait
        $this->turnRight();
    }

    /**
     * If the robot was to move forward, what would it's position be?
     */
    public function getNextPosition()
    {
        // Because we want to keep the same method name in the robot, we alias the trait's getNextPosition above
        return $this->traitGetNextPosition($this->getCurrentDirection());
    }

    /**
     * Has the robot been placed yet?
     *
     * @return bool
     */
    public function isNotPlaced()
    {
        try {
            $this->getPosition()->checkPositionInitialised();
        } catch (Exception $e) {
            return true;
        }

        return false;
    }
}
