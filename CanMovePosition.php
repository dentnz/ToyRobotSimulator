<?php
namespace ToyRobotSimulator;

require_once('Position.php');

trait CanMovePosition
{
    /**
     * @var \ToyRobotSimulator\Position Current position
     */
    protected $position;
    
    /**
     * @var \ToyRobotSimulator\Position Another position used to test next position, without moving current position
     */
    protected $nextPosition;

    public function __construct()
    {
        $this->position = new Position();
        $this->nextPosition = new Position();
    }
    
    /**
     * Move a position in a supplied direction 
     *
     * @param \ToyRobotSimulator\Position $position
     * @param string $direction Direction to move in
     */
    public function movePosition($position, $direction)
    {
        if ($direction == 'NORTH') {
            $position->moveNorth();
        }
        if ($direction == 'EAST') {
            $position->moveEast();
        }
        if ($direction == 'SOUTH') {
            $position->moveSouth();
        }
        if ($direction == 'WEST') {
            $postion->moveWest();
        }
    }

    /**
     * Given a direction and the current direction, determine where the next position would be, but don't move
     *
     * @param $currentDirection 
     * @return \ToyRobotSimulator\Position
     */
    public function getNextPosition($direction) 
    {    
        $this->nextPosition->setPosition($this->position->getX(), $this->position->getY());
        $this->movePosition($this->nextPosition, $direction);
        return $this->nextPosition;
    }

    /**
     * Place something into position
     *
     * @param int $x X position
     * @param int $y Y position
     * @param string $direction e.g NORTH
     */
    public function placePosition($x, $y)
    {
        $this->position->setPosition($x, $y);
    }

    /**
     * @return \ToyRobotSimulator\Position
     */
    public function getPosition()
    {
        return $this->position;
    }
}
