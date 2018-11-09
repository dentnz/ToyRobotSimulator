<?php
namespace ToyRobotSimulator;

require_once('Tester.php');
$tester = new Tester();

// Load in test classes
require_once('CanFaceDirectionTests.php');
require_once('PositionTests.php');
require_once('CanMovePositionTests.php');
require_once('RobotTests.php');
require_once('TabletopTests.php');

// Run tests
$canFaceDirectionTests = new CanFaceDirectionTests();
$canFaceDirectionTests->runTests($tester);

$positionTests = new PositionTests();
$positionTests->runTests($tester);

$canMovePositionTests = new CanMovePositionTests();
$canMovePositionTests->runTests($tester);

$robotTests = new RobotTests();
$robotTests->runTests($tester);

$tableTopTests = new TabletopTests();
$tableTopTests->runTests($tester);

$tester->totals();
