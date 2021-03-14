<?php

namespace ryunosuke\Test\Documentize\Command;

use ryunosuke\Documentize\Command\DocumentizeCommand;
use ryunosuke\Functions\Package\FileSystem;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class DocumentizeCommandTest extends \ryunosuke\Test\AbstractUnitTestCase
{
    /**
     * @var Application
     */
    protected $app;

    protected $commandName = 'generate';

    protected $defaultArgs = [];

    protected function setup()
    {
        parent::setUp();

        $this->app = new Application('Test');
        $this->app->setCatchExceptions(false);
        $this->app->setAutoExit(false);
        $this->app->add(new DocumentizeCommand());
    }

    /**
     * @param array $inputArray
     * @return string
     */
    protected function runApp($inputArray)
    {
        $inputArray = [
                'command' => $this->commandName
            ] + $inputArray + $this->defaultArgs;

        $input = new ArrayInput($inputArray);
        $output = new BufferedOutput();

        $this->app->run($input, $output);

        return $output->fetch();
    }

    function test_generate()
    {
        $tmpdir = sys_get_temp_dir();
        FileSystem::rm_rf("$tmpdir/rdz-test");

        $output = $this->runApp([
            'source'      => __DIR__ . '/_DocumentizeCommand',
            'destination' => "$tmpdir/rdz-test",
            '--cachedir'  => "$tmpdir/rdz-test",
            '--stats'     => true,
            '-vvv'        => true,
        ]);
        $this->assertContains('Gather and parse files from', $output);
        $this->assertContains('Found 0 markdowns, 0 constants, 0 functions, 0 interfaces, 0 traits, 1 classes in 1 namespaces', $output);
        $this->assertContains('Input php count 2 files', $output);
    }

    function test_no_generate()
    {
        $tmpdir = sys_get_temp_dir();
        FileSystem::rm_rf("$tmpdir/rdz-test");

        $output = $this->runApp([
            'source'      => __DIR__ . '/_DocumentizeCommand',
            'destination' => "$tmpdir/rdz-test",
            '--template'  => "notfoundfile",
        ]);
        $this->assertContains('is not found', $output);
        $this->assertContains('no generate', $output);
    }

    function test_fatal()
    {
        ob_start();
        $tmpdir = sys_get_temp_dir();
        $output = $this->runApp([
            'source'      => __DIR__ . '/notfounddir',
            'destination' => "$tmpdir/rdz-test",
        ]);
        $output .= ob_get_clean();
        $this->assertContains('Uncaught InvalidArgumentException', $output);
    }
}
