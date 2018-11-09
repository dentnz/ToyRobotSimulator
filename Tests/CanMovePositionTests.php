<?php
namespace ToyRobotSimulator;

use Exception;

require('../CanMovePosition.php');

class CanMove {
    use CanMovePosition;
}

class CanMovePositionTests
{
    /**
     * @param \ToyRobotSimulator\Tester
     */
    public function runTests($tester)
    {
        $canMove = new CanMove();
        
        $tester->setScenario('Can Move Position Tests');
        $tester->setTest('Test placing at 0, 0 then moving NORTH');
        $canMove->placePosition(0, 0);
        $canMove->movePosition($canMove->getPosition(), NORTH);
        $tester->assertAreEqual($canMove->getPosition()->getX(), 0, 'Still in x = 0');
        $tester->assertAreEqual($canMove->getPosition()->getY(), 1, 'y = 1');

        $tester->setTest('Test getting next position, without moving current position');
        $nextPosition = $canMove->getNextPosition(NORTH);
        $tester->assertAreEqual($nextPosition->getY(), 2, 'Next Y position would be 2');
        $tester->assertAreEqual($canMove->getPosition()->getY(), 1, 'But current Y position is still 1');
    }
}
