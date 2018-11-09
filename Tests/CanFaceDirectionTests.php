<?php
namespace ToyRobotSimulator;

use Exception;

require('../CanFaceDirection.php');

class CanFace {
    use CanFaceDirection;
}

class CanFaceDirectionTests
{
    /**
     * @param \ToyRobotSimulator\Tester
     */
    public function runTests($tester)
    {
        $canFace = new CanFace();
        
        $tester->setScenario('Can Face Direction Tests');
        
        // Test setting and getting of facing direction
        $tester->setTest('Set valid direction test');
        $canFace->face('NORTH');
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'NORTH', 'NORTH');
        $canFace->face('EAST');
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'EAST', 'EAST');
        $canFace->face('SOUTH');
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'SOUTH', 'SOUTH');
        $canFace->face('WEST');
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'WEST', 'WEST');
        
        // Test invalid direction detection
        $tester->setTest('Invalid direction test');
        try {
            $canFace->face('INVALID DIRECTION');
            $tester->testFailed();
        } catch (Exception $e) {
            $tester->assertAreEqual($e->getMessage(), 'Invalid direction');
        }
        
        // Fresh CanFace...
        $canFace = new CanFace();
        
        // Test rotateLeft no initial direction set
        $tester->setTest('Left no initial direction set test');
        try {
            $canFace->turnLeft();
            $tester->testFailed();
        } catch (Exception $e) {
            $tester->assertAreEqual($e->getMessage(), 'No initial direction set');
        }
        
        // Test rotateLeft no initial direction set
        $tester->setTest('Right no initial direction set test');
        try {
            $canFace->turnRight();
            $tester->testFailed();
        } catch (Exception $e) {
            $tester->assertAreEqual($e->getMessage(), 'No initial direction set');
        }
        
        // Test rotateRight from NORTH
        $tester->setTest('Right from initial NORTH tests');
        $canFace->face('NORTH');
        $canFace->turnRight();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'EAST', 'Should be EAST');
        $canFace->turnRight();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'SOUTH', 'Should be SOUTH');
        $canFace->turnRight();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'WEST', 'Should be WEST');
        $canFace->turnRight();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'NORTH', 'Should be NORTH again');

        // Test rotateRight from NORTH
        $tester->setTest('Right from initial WEST tests');
        $canFace->face('WEST');
        $canFace->turnRight();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'NORTH', 'Should be NORTH');
        $canFace->turnRight();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'EAST', 'Should be EAST');
        $canFace->turnRight();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'SOUTH', 'Should be SOUTH');
        $canFace->turnRight();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'WEST', 'Should be WEST again');
        
        // Test rotateLeft from NORTH
        $tester->setTest('Left from initial NORTH tests');
        $canFace->face('NORTH');
        $canFace->turnLeft();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'WEST', 'Should be WEST');
        $canFace->turnLeft();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'SOUTH', 'Should be SOUTH');
        $canFace->turnLeft();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'EAST', 'Should be EAST');
        $canFace->turnLeft();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'NORTH', 'Should be NORTH again');

        // Test rotateLeft from NORTH
        $tester->setTest('Left from initial EAST tests');
        $canFace->face('EAST');
        $canFace->turnLeft();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'NORTH', 'Should be NORTH');
        $canFace->turnLeft();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'WEST', 'Should be WEST');
        $canFace->turnLeft();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'SOUTH', 'Should be SOUTH');
        $canFace->turnLeft();
        $tester->assertAreEqual($canFace->getCurrentDirection(), 'EAST', 'Should be EAST again');
    }
}
