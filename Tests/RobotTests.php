<?php
namespace ToyRobotSimulator;

use Exception;

require_once('../Robot.php');

class RobotTests
{
    /**
     * @param \ToyRobotSimulator\Tester
     */
    public function runTests($tester)
    {
        $robot = new Robot();
        
        $tester->setScenario('Robot Tests');
        
        $tester->setTest('Place robot at 0, 0 NORTH, and move it around');
        $robot->place(0, 0, 'NORTH');
        $robot->move();
        $tester->assertAreEqual($robot->getCurrentDirection(), 'NORTH', 'Moved north, still facing NORTH');
        $tester->assertAreEqual($robot->getPosition()->getX() == 0 && $robot->getPosition()->getY() == 1, 
            true, 'And we are in position 0, 1');
        $robot->right();
        $tester->assertAreEqual($robot->getCurrentDirection(), 'EAST', 'We turned right and are now facing EAST');
        $robot->move();
        $tester->assertAreEqual($robot->getPosition()->getX() == 1 && $robot->getPosition()->getY() == 1, 
            true, 'And we are in position 1, 1');
        $robot->move();
        $robot->move();
        $robot->move();
        $tester->assertAreEqual($robot->getPosition()->getX() == 4 && $robot->getPosition()->getY() == 1, true, 
            'We moved 3 times, so now in position 4, 1');
        $robot->move();
        $robot->move();
        // Note that a robot is free to move around wherever they like - there is no concept of a tabletop
        $tester->assertAreEqual($robot->getPosition()->getX() == 6 && $robot->getPosition()->getY() == 1, true, 
            'We moved 2 more times, so now in position 6, 1');
        $robotsNextPosition = $robot->getNextPosition();
        $tester->assertAreEqual($robotsNextPosition->getX() == 7 && $robotsNextPosition->getY() == 1, 
            true, 'If we were to move, next position would be 7, 1');
    }
}
