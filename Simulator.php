<?php
namespace ToyRobotSimulator;

require_once('Robot.php');
require_once('Tabletop.php');
require_once('Console.php');

use Exception;

/**
 * Toy Robot Simulator
 *
 * Brings together the Robot and Tabletop objects to create a Toy Robot Simulation. In the simulation, a robot is able 
 * to walk freely around a 4x4 tabletop in four directions. The robot is restricted from falling off the table.
 *
 * @author Karl Lurman <karl.lurman@gmail.com>
 */
class Simulator
{
    /**
     * Internal references to some injected dependencies
     */
    protected $tableTop;
    protected $robot;
    protected $console;
    
    /**
     * @param \ToyRobotSimulator\TableTop $tableTop Table Top
     * @param \ToyRobotSimulator\Robot $robot A Robot
     * @param \ToyRobotSimulator\Console $console A console to deal with input/output
     */
    public function __construct($tableTop, $robot, $console)
    {
        $this->tableTop = $tableTop;
        $this->robot = $robot;
        $this->console = $console;
    }

    /**
     * Place the robot in a position, facing a given direction. Checks to see if supplied x, y are on the table top.
     *
     * @param int $x Robot X position
     * @param int $y Robot Y position
     * @param string $direction Robot facing direction, e.g NORTH
     */
    public function place($x, $y, $direction)
    {
        try {
            $this->tableTop->checkInBounds($x, $y);
        } catch (Exception $e) {
            return $this->console->log('Cannot place robot out of bounds');
        }

        $this->robot->place($x, $y, $direction);
    }

    /**
     * Move robot forward once position, checking robot won't fall off the table
     */
    public function move()
    {
        // Only move the robot if it will stay on the table top
        try {
            $robotsNextPosition = $this->robot->getNextPosition();
            $this->tableTop->checkInBounds($robotsNextPosition->getX(), $robotsNextPosition->getY());
            $this->robot->move();
        } catch (Exception $e) {
            return false;
        }        
    }

    /**
     * Change the robots facing direction, rotating it to the left
     */
    public function left()
    {
        try {
            $this->robot->left();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Change the robots facing direction, rotating it to the right
     */
    public function right()
    {
        try {
            $this->robot->right();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Log out the robots current position on the tabletop, and current facing direction
     */
    public function report() 
    {
        if ($this->robot->isNotPlaced()) {
            return false;
        }

        $this->console->log(
            $this->robot->getPosition()->getX() . ',' . 
            $this->robot->getPosition()->getY() . ',' . 
            $this->robot->getCurrentDirection()
        );
    }

    /**
     * Run the simulation
     *
     * Waits for commands from the CLI/console, processes commands, moves the robot around on the tabletop
     */
    public function run()
    {
        do {
            $command = $this->console->get();
            switch ($command) {
                case 'LEFT':
                    $this->left();
                    break;
                case 'RIGHT':
                    $this->right();
                    break;
                case 'MOVE':
                    $this->move();
                    break;
                case 'REPORT':
                    $this->report();
                    break;
            }
            
            if (strpos($command, 'PLACE ', 0) === 0) {
                $command = str_replace('PLACE ', '', $command);
                $commands = explode(',', $command);
                try {
                    $this->place($commands[0], $commands[1], $commands[2]);
                } catch (Exception $e) {
                    // Ignore command
                }
            }
        } while ($command != 'EXIT');

        exit(0);
    }
}

$tableTop = new Tabletop(4, 4);
$robot = new Robot();
$console = new Console();

$simulator = new Simulator($tableTop, $robot, $console);
$simulator->run();
