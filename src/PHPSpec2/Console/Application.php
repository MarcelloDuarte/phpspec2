<?php

namespace PHPSpec2\Console;

use PHPSpec2\Loader\ConfigurationLoader as Loader;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Application extends BaseApplication
{
    /**
     * {@inheritdoc}
     */
    public function __construct($version)
    {
        parent::__construct('PHPSpec2', $version);

        $dispatcher = new EventDispatcher();
        $configuration = $this->loadConfiguration();

        $this->add(new Command\RunCommand($dispatcher));
        $this->add(new Command\DescribeCommand($dispatcher));
    }

    /**
     * {@inheritdoc}
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        if (!($name = $this->getCommandName($input))) {
            $input = new ArrayInput(array('command' => 'run'));
        }

        parent::doRun($input, $output);
    }

    private function loadConfiguration()
    {
        $loader = new Loader();
        if (file_exists('phpspec.yml')) {
            return $loader->loadFromFile('phpspec.yml');
        }
        return array();
    }
}
