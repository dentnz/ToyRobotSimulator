<?php
namespace ToyRobotSimulator;

/**
 * Console logging - output and input handling
 *
 * @author Karl Lurman <karl.lurman@gmail.com> 
 */
class Console
{
    public function log($message) 
    {
        fwrite(STDOUT, $message . "\n");
    }

    public function get()
    {
        // Strip new lines
        return str_replace("\n", '', fgets(STDIN));
    }
}