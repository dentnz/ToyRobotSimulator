<?php
namespace ToyRobotSimulator;

use Exception;

require('../Position.php');

class PositionTests
{
    /**
     * @param \ToyRobotSimulator\Tester
     */
    public function runTests($tester)
    {
        $tester->setScenario('Position Tests');
        $position = new Position();
        
        $tester->setTest('Initialisation must happen before movement');
        try {
            $position->moveNorth();
            $tester->testFailed();
        } catch (Exception $e) {
            $tester->assertAreEqual($e->getMessage(), 'Position not initialised', 'moveNorth');
        }

        try {
            $position->moveEast();
            $tester->testFailed();
        } catch (Exception $e) {
            $tester->assertAreEqual($e->getMessage(), 'Position not initialised', 'moveEast');
        }

        try {
            $position->moveSouth();
            $tester->testFailed();
        } catch (Exception $e) {
            $tester->assertAreEqual($e->getMessage(), 'Position not initialised', 'moveSouth');
        }

        try {
            $position->moveWest();
            $tester->testFailed();
        } catch (Exception $e) {
            $tester->assertAreEqual($e->getMessage(), 'Position not initialised', 'moveWest');
        }

        $position = new Position();
        $tester->setTest('Setting and Getting position, 0, 0');
        $position->setPosition(0, 0);
        if ($position->getX() == 0 && $position->getY() == 0) {
            $tester->testPassed();
        } else {
            $tester->testFailed();
        }

        $position = new Position();
        $tester->setTest('Setting and Getting position, -1, -1');
        $position->setPosition(-1, -1);
        if ($position->getX() == -1 && $position->getY() == -1) {
            $tester->testPassed();
        } else {
            $tester->testFailed();
        }

        $position = new Position();        
        $tester->setTest('moveNorth from position, 0, 0 to 0, 1');
        $position->setPosition(0, 0);
        $position->moveNorth();
        if ($position->getX() == 0 && $position->getY() == 1) {
            $tester->testPassed();
        } else {
            $tester->testFailed();
        }

        $position = new Position();        
        $tester->setTest('moveWest from position, 0, 0 to -1, 0');
        $position->setPosition(0, 0);
        $position->moveWest();
        if ($position->getX() == -1 && $position->getY() == 0) {
            $tester->testPassed();
        } else {
            $tester->testFailed();
        }

        $position = new Position();        
        $tester->setTest('moveSouth twice from position, 0, 0 to -2, 0');
        $position->setPosition(0, 0);
        $position->moveSouth();
        $position->moveSouth();
        if ($position->getX() == 0 && $position->getY() == -2) {
            $tester->testPassed();
        } else {
            $tester->testFailed();
        }

        $position = new Position();        
        $tester->setTest('moveEast twice from position, 0, 0 to 0, 2');
        $position->setPosition(0, 0);
        $position->moveEast();
        $position->moveEast();
        if ($position->getX() == 2 && $position->getY() == 0) {
            $tester->testPassed();
        } else {
            $tester->testFailed();
        }
    }
}
