<?php
namespace ToyRobotSimulator;

require('../Console.php');

/**
 * Tester
 *
 * A rudimentary testing tool. Logs output to console, including test totals. Can also do basic assertions (on simple types)
 *
 * @author Karl Lurman <karl.lurman@gmail.com>
 */
class Tester
{
    /**
     * Totals
     */
    protected $totalPassed = 0;
    protected $totalFailed = 0;
    protected $totalRun = 0;

    /**
     * Test name
     *
     * @var string
     */
    protected $test = '';
    
    /**
     * Internal Console reference
     *
     * @var ToyRobotSimulator\Console
     */
    protected $console;

    public function __construct()
    {
        $this->console = new Console();
    }

    /**
     * @param string $scenario Scenario being tested
     */
    public function setScenario($scenario)
    {
        $this->console->log("\n" . 'Scenario: ' . $scenario);
    }

    /**
     * @param string $test Test case being tested
     */
    public function setTest($test)
    {
        $this->test = $test;
    }

    /**
     * Log failed current test
     *
     * @param string $additionalMessage Additional message for test fail
     */
    public function testFailed($additionalMessage = '') 
    {
        $message = $additionalMessage ? ' - ' . $additionalMessage : '';
        $this->console->log($this->test . $message . ' = Failed');
        $this->totalFailed++;
        $this->total++;
    }

    /**
     * Log passed current test
     *
     * @param string $additionalMessage Additional message for test fail
     */
    public function testPassed($additionalMessage = '') 
    {
        $message = $additionalMessage ? ' - ' . $additionalMessage : '';
        $this->console->log($this->test . $message . ' = Passed');
        $this->totalPassed++;
        $this->total++;
    }

    /**
     * Test two things are equal, logging pass/fail
     *
     * @param mixed $thingA Basic type, e.g String, Int
     * @param mixed $thingB Basic type, e.g String, Int
     * @param mixed $extraMessage Additional message for pass/fail
     * @return bool
     */
    public function assertAreEqual($thingA, $thingB, $additionalMessage = '')
    {
        if ($thingA === $thingB) {
            return $this->testPassed($additionalMessage);
        }

        // Show the difference in the strings in our additional message
        $additionalMessage = $addtionalMessage . $thingA . ' != ' . $thingB;

        $this->testFailed($additionalMessage);
    }

    /**
     * Log out our test totals
     */
    public function totals()
    {
        $this->console->log('Total Tests/Assertions: ' . $this->total);
        $this->console->log('Total Passed: ' . $this->totalPassed);
        $this->console->log('Total Failed: ' . $this->totalFailed);
    }
}
