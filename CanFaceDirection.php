<?php
namespace ToyRobotSimulator;

use Exception;

/**
 * CanFaceDirection Trait
 *
 * Set a facing direction and be able to turn left or right through NORTH, EAST, SOUTH, or WEST. Allows you 
 * to associate a (facing direction) with any object... including toy robots!
 * 
 * @author Karl Lurman <karl.lurman@gmail.com>
 */
trait CanFaceDirection
{
    /**
     * @var array Array used to validate directions and determine next direction while turning left and right
     */
    protected $directions = array(
        'NORTH',
        'EAST',
        'SOUTH',
        'WEST',
    );

    /**
     * @var string|null The current facing direction
     */
    protected $currentDirection;

    /**
     * Validate direction against our allowed directions
     *
     * @param string $direction e.g NORTH
     * @throws Exception Invalid Direction supplied
     */
    protected function validateDirection($direction) 
    {
        if (!in_array($direction, $this->directions)) {
            throw new Exception('Invalid direction');
        }
    }

    /**
     * Face the current direction
     *
     * @param string $direction e.g NORTH
     */
    public function face($direction) 
    {
        $this->validateDirection($direction);
        $this->currentDirection = $direction;
    }

    /**
     * @return string Get current facing direction
     */
    public function getCurrentDirection() {
        return $this->currentDirection;
    }

    /**
     * Checks to see if a facing direction has been initialised - usually before turning left or right 
     *
     * @throws Exception
     */
    protected function checkDirectionInitialised() 
    {
        if ($this->getCurrentDirection() == null) {
            throw new Exception('No initial direction set');
        }
    }

    /**
     * Turn left
     */
    public function turnLeft() 
    {
        $this->checkDirectionInitialised();
        $currentDirection = $this->getCurrentDirection();
        
        // We are using PHPs array pointer stuff to deal with moving through the array
        // Start from last direction when turning left
        end($this->directions);        
        $direction = current($this->directions);

        // Move our directions array pointer to the current facing direction
        while ($direction != $currentDirection) {
            $direction = prev($this->directions);
        }

        // Move to the previous direction (to the left)
        prev($this->directions);
        
        // And if we have gone past the first direction, reset to the last (WEST in this case)
        if (current($this->directions) === false) {
            end($this->directions);
        }

        $this->face(current($this->directions));
    }

    /**
     * Turn right
     */
    public function turnRight() 
    {
        $this->checkDirectionInitialised();
        $currentDirection = $this->getCurrentDirection();

        // We are using PHPs array pointer stuff to deal with moving through the array
        // Start from the first direction when turning right
        reset($this->directions);        
        $direction = current($this->directions);

        // Move our directions array pointer to the current facing direction
        while ($direction != $currentDirection) {
            $direction = next($this->directions);
        }

        // Move to next direction (to the right)
        next($this->directions);
        
        // And if we have gone past the last direction, reset to the first (NORTH in this case)
        if (current($this->directions) === false) {
            reset($this->directions);
        }

        $this->face(current($this->directions));
    }
}
