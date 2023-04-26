<?php

namespace ryunosuke\Test\Documentize\Command;

use ryunosuke\Documentize\Command\DocumentizeCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use function ryunosuke\Documentize\rm_rf;

class DocumentizeCommandTest extends \ryunosuke\Test\AbstractUnitTestCase
{
    /**
     * @var Application
     */
    protected $app;

    protected $commandName = 'generate';

    protected $defaultArgs = [];

    protected function setup(): void
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
        rm_rf("$tmpdir/rdz-test");

        $output = $this->runApp([
            'source'      => __DIR__ . '/_DocumentizeCommand',
            'destination' => "$tmpdir/rdz-test",
            '--config'    => $this->writePhpFile([
                'cachedir' => "$tmpdir/rdz-test",
                'stats'    => true,
            ]),
            '-vvv'        => true,
        ]);
        $this->assertStringContainsString('Gather and parse files from', $output);
        $this->assertStringContainsString('Found 0 markdowns, 0 constants, 0 functions, 0 interfaces, 0 traits, 1 classes in 1 namespaces', $output);
        $this->assertStringContainsString('Input php count 2 files', $output);
    }

    function test_no_generate()
    {
        $tmpdir = sys_get_temp_dir();
        rm_rf("$tmpdir/rdz-test");

        $output = $this->runApp([
            'source'      => __DIR__ . '/_DocumentizeCommand',
            'destination' => "$tmpdir/rdz-test",
            '--template'  => "notfoundfile",
        ]);
        $this->assertStringContainsString('is not found', $output);
        $this->assertStringContainsString('no generate', $output);
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
        $this->assertStringContainsString('Uncaught InvalidArgumentException', $output);
    }
}
