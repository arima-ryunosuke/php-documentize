<?php

namespace ryunosuke\Documentize\Command;

use ryunosuke\Documentize\Document;
use ryunosuke\Documentize\Utils\FileSystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DocumentizeCommand extends Command
{
    const VERSION = "1.0.2";

    protected function configure()
    {
        $this->setName('generate')->setDescription('generate document from phpdoc.');
        $this->setDefinition([
            new InputArgument('source', InputArgument::REQUIRED, 'Specify Source path'),
            new InputArgument('destination', InputArgument::REQUIRED, 'Specify Destination path'),
            new InputOption('autoload', 'a', InputOption::VALUE_OPTIONAL, 'Specify Autoload file'),
            new InputOption('cachedir', null, InputOption::VALUE_REQUIRED, 'Specify cache directory', sys_get_temp_dir() . '/rdz-' . self::VERSION),
            new InputOption('force', null, InputOption::VALUE_NONE, 'Specify cache recreation'),
            new InputOption('recursive', 'r', InputOption::VALUE_NONE, 'Specify Recursive flag'),
            new InputOption('include', 'i', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Specify Include pattern', ['*.php']),
            new InputOption('exclude', 'e', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Specify Exclude pattern'),
            new InputOption('contain', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Specify Contain fqsen', ['*']),
            new InputOption('except', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Specify Except fqsen'),
            new InputOption('template', 't', InputOption::VALUE_REQUIRED, 'Specify Template script'),
            new InputOption('template-config', 'c', InputOption::VALUE_REQUIRED, 'Specify Template config script'),
            new InputOption('stats', null, InputOption::VALUE_NONE, 'Display statistic'),
            new InputOption('no-internal', null, InputOption::VALUE_NONE),
            new InputOption('no-internal-constant', null, InputOption::VALUE_NONE),
            new InputOption('no-internal-function', null, InputOption::VALUE_NONE),
            new InputOption('no-internal-type', null, InputOption::VALUE_NONE),
            new InputOption('no-internal-property', null, InputOption::VALUE_NONE),
            new InputOption('no-internal-method', null, InputOption::VALUE_NONE),
            new InputOption('no-deprecated', null, InputOption::VALUE_NONE),
            new InputOption('no-deprecated-constant', null, InputOption::VALUE_NONE),
            new InputOption('no-deprecated-function', null, InputOption::VALUE_NONE),
            new InputOption('no-deprecated-type', null, InputOption::VALUE_NONE),
            new InputOption('no-deprecated-property', null, InputOption::VALUE_NONE),
            new InputOption('no-deprecated-method', null, InputOption::VALUE_NONE),
            new InputOption('no-magic', null, InputOption::VALUE_NONE),
            new InputOption('no-magic-property', null, InputOption::VALUE_NONE),
            new InputOption('no-magic-method', null, InputOption::VALUE_NONE),
            new InputOption('no-virtual', null, InputOption::VALUE_NONE),
            new InputOption('no-virtual-constant', null, InputOption::VALUE_NONE),
            new InputOption('no-virtual-property', null, InputOption::VALUE_NONE),
            new InputOption('no-virtual-method', null, InputOption::VALUE_NONE),
            new InputOption('no-private', null, InputOption::VALUE_NONE),
            new InputOption('no-private-constant', null, InputOption::VALUE_NONE),
            new InputOption('no-private-property', null, InputOption::VALUE_NONE),
            new InputOption('no-private-method', null, InputOption::VALUE_NONE),
            new InputOption('no-protected', null, InputOption::VALUE_NONE),
            new InputOption('no-protected-constant', null, InputOption::VALUE_NONE),
            new InputOption('no-protected-property', null, InputOption::VALUE_NONE),
            new InputOption('no-protected-method', null, InputOption::VALUE_NONE),
            new InputOption('no-public', null, InputOption::VALUE_NONE),
            new InputOption('no-public-constant', null, InputOption::VALUE_NONE),
            new InputOption('no-public-property', null, InputOption::VALUE_NONE),
            new InputOption('no-public-method', null, InputOption::VALUE_NONE),
        ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $src = FileSystem::path_resolve($input->getArgument('source'));
        $dst = FileSystem::path_resolve($input->getArgument('destination'));
        $tpl = $input->getOption('template');
        $tpl = $tpl ? FileSystem::path_resolve($tpl) : __DIR__ . '/../../template/simple/bootstrap.php';
        $tplcfg = FileSystem::path_resolve($input->getOption('template-config'));

        $cachedir = $input->getOption('cachedir');
        if ($cachedir) {
            $cachedir = FileSystem::path_resolve($cachedir);
            FileSystem::mkdir_p($cachedir);
        }

        $autoloader = $input->getOption('autoload');
        if ($autoloader !== '') {
            $autoloader = FileSystem::path_resolve($autoloader ?: FileSystem::dirname_r($src, function ($path) {
                return realpath("$path/vendor/autoload.php");
            }));
        }

        $options = [
            'target'                 => $src,
            'autoloader'             => $autoloader,
            'cachedir'               => $cachedir,
            'force'                  => $input->getOption('force'),
            'recursive'              => $input->getOption('recursive'),
            'include'                => $input->getOption('include'),
            'exclude'                => $input->getOption('exclude'),
            'contain'                => $input->getOption('contain'),
            'except'                 => $input->getOption('except'),
            'no-internal-constant'   => $input->getOption('no-internal') || $input->getOption('no-internal-constant'),
            'no-internal-function'   => $input->getOption('no-internal') || $input->getOption('no-internal-function'),
            'no-internal-type'       => $input->getOption('no-internal') || $input->getOption('no-internal-type'),
            'no-internal-property'   => $input->getOption('no-internal') || $input->getOption('no-internal-property'),
            'no-internal-method'     => $input->getOption('no-internal') || $input->getOption('no-internal-method'),
            'no-deprecated-constant' => $input->getOption('no-deprecated') || $input->getOption('no-deprecated-constant'),
            'no-deprecated-function' => $input->getOption('no-deprecated') || $input->getOption('no-deprecated-function'),
            'no-deprecated-type'     => $input->getOption('no-deprecated') || $input->getOption('no-deprecated-type'),
            'no-deprecated-property' => $input->getOption('no-deprecated') || $input->getOption('no-deprecated-property'),
            'no-deprecated-method'   => $input->getOption('no-deprecated') || $input->getOption('no-deprecated-method'),
            'no-magic-property'      => $input->getOption('no-magic') || $input->getOption('no-magic-property'),
            'no-magic-method'        => $input->getOption('no-magic') || $input->getOption('no-magic-method'),
            'no-virtual-constant'    => $input->getOption('no-virtual') || $input->getOption('no-virtual-constant'),
            'no-virtual-property'    => $input->getOption('no-virtual') || $input->getOption('no-virtual-property'),
            'no-virtual-method'      => $input->getOption('no-virtual') || $input->getOption('no-virtual-method'),
            'no-private-constant'    => $input->getOption('no-private') || $input->getOption('no-private-constant'),
            'no-private-property'    => $input->getOption('no-private') || $input->getOption('no-private-property'),
            'no-private-method'      => $input->getOption('no-private') || $input->getOption('no-private-method'),
            'no-protected-constant'  => $input->getOption('no-protected') || $input->getOption('no-protected-constant'),
            'no-protected-property'  => $input->getOption('no-protected') || $input->getOption('no-protected-property'),
            'no-protected-method'    => $input->getOption('no-protected') || $input->getOption('no-protected-method'),
            'no-public-constant'     => $input->getOption('no-public') || $input->getOption('no-public-constant'),
            'no-public-property'     => $input->getOption('no-public') || $input->getOption('no-public-property'),
            'no-public-method'       => $input->getOption('no-public') || $input->getOption('no-public-method'),
        ];

        $output->writeln(sprintf("Gather and parse files from <info>%s</info>", $src));

        $result = Document::gatherIsolative($options, $errors);
        if ($result === false) {
            $output->writeln("<fg=red>$errors</>");
            return;
        }
        $namespaces = $result['namespaces'];

        foreach ($result['logs'] as $log) {
            $map = [
                E_NOTICE       => 'fg=yellow',
                E_USER_NOTICE  => 'fg=yellow',
                E_WARNING      => 'fg=magenta',
                E_USER_WARNING => 'fg=magenta',
                E_ERROR        => 'fg=red',
                E_USER_ERROR   => 'fg=red',
            ];
            $tag = $map[$log['errorno']] ?? 'fg=default';
            $message = $log['message'] . ($output->isDebug() ? ' at ' . $log['file'] . '#' . $log['line'] : '');
            $output->writeln("<$tag>" . $message . "</>");
        }

        FileSystem::mkdir_p($dst);
        $starttime = time();
        $generatetime = microtime(true);
        $generator = (require $tpl)($namespaces, $dst, $tplcfg);
        if ($generator instanceof \Generator) {
            foreach ($generator as $out) {
                $output->writeln(sprintf("Create file to <info>%s</info>", $out), OutputInterface::VERBOSITY_VERBOSE);
            }
        }
        $generatetime = microtime(true) - $generatetime;

        if ($input->getOption('stats')) {
            $filelist = FileSystem::file_list($dst, function ($file) use ($starttime) { return filemtime($file) >= $starttime; });
            $gencount = count($filelist);
            $gensize = array_sum(array_map('filesize', $filelist));

            $counter = static function ($namespaces, $category) use (&$counter) {
                $count = 0;
                foreach ($namespaces['namespaces'] as $namespace) {
                    $count += count($namespace[$category]);
                    $count += $counter($namespace, $category);
                }
                return $count;
            };
            $output->writeln(implode(' ', [
                'Found',
                sprintf('<info>%s</info> constants,', number_format($counter(['namespaces' => $namespaces], 'constants'))),
                sprintf('<info>%s</info> functions,', number_format($counter(['namespaces' => $namespaces], 'functions'))),
                sprintf('<info>%s</info> interfaces,', number_format($counter(['namespaces' => $namespaces], 'interfaces'))),
                sprintf('<info>%s</info> traits,', number_format($counter(['namespaces' => $namespaces], 'traits'))),
                sprintf('<info>%s</info> classes', number_format($counter(['namespaces' => $namespaces], 'classes'))),
                'in',
                sprintf('<comment>%s</comment> namespaces', number_format(count($namespaces) + $counter(['namespaces' => $namespaces], 'namespaces'))),
            ]));
            $output->writeln(sprintf('Gathering time <comment>%s</comment> seconds', number_format($result['time'], 3)));
            $output->writeln(sprintf('Input php count <comment>%s</comment> files', number_format($result['read'])));
            $output->writeln(sprintf('Generating time <comment>%s</comment> seconds', number_format($generatetime, 3)));
            $output->writeln(sprintf('Output html count <comment>%s</comment> files', number_format($gencount)));
            $output->writeln(sprintf('Output total size <comment>%s</comment> bytes', number_format($gensize)));
            $output->writeln(sprintf('Peak Memory <comment>%s</comment> bytes', number_format($result['memory'])));
        }
    }
}
