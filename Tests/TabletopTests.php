<?php
namespace ToyRobotSimulator;

use Exception;

require('../Tabletop.php');

class TabletopTests
{
    /**
     * @param \ToyRobotSimulator\Tester
     */
    public function runTests($tester)
    {
        $tabletop = new Tabletop(4, 4);
        
        $tester->setScenario('5x5 Tabletop Bounds Tests');
        
        // Test width
        $tester->setTest('Width test');
        $tester->assertAreEqual($tabletop->getWidth(), 4);

        // Test height
        $tester->setTest('Height test');
        $tester->assertAreEqual($tabletop->getHeight(), 4);

        $tester->setTest('Test checkInBounds positives');
        $tester->assertAreEqual($tabletop->checkInBounds(0, 0), true, '0, 0');
        $tester->assertAreEqual($tabletop->checkInBounds(4, 4), true, '4, 4');
        $tester->assertAreEqual($tabletop->checkInBounds(2, 2), true, '2, 2');

        $tester->setTest('Test checkInBounds negatives');     
        try {
            $tabletop->checkInBounds(-1, -5);
        } catch (Exception $e) {
            $tester->assertAreEqual($e->getMessage(), 'Out of bounds', '-1, -5');
        }
        try {
            $tabletop->checkInBounds(10, 3);
        } catch (Exception $e) {
            $tester->assertAreEqual($e->getMessage(), 'Out of bounds', '10, 3');
        }
        try {
            $tabletop->checkInBounds(6, 6);
        } catch (Exception $e) {
            $tester->assertAreEqual($e->getMessage(), 'Out of bounds', '6, 6');
        }
    }
}
