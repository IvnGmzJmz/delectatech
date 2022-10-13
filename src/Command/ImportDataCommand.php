<?php

namespace Command;

use Exception;
use Domain\Services\Command\CommandService;
use Domain\Services\ImportDataService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ImportDataCommand extends Command
{
    /**
     * @var CommandService
     */
    private $commandService;

    private $container;

    /**
     * @var ImportDataService
     */
    private $importDataService;

    protected static $defaultName = 'symfony:import-data';

    /**
     * TestCommand constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
        $this->commandService = $container->get(CommandService::class);
        $this->importDataService = $container->get(ImportDataService::class);
    }

    /**
     * This method is executed before the interact() and the execute() methods.
     * Its main purpose is to initialize variables used in the rest of the command methods.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->commandService->setInput($input);
        $this->commandService->setOutput($output);
    }

    protected function configure()
    {
        $this->setDescription('Command to import data from json file.')
            ->addArgument('fileInput', InputArgument::REQUIRED, 'File Path of import data');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->commandService->initializeTimer();
        $filePath = $input->getArgument("fileInput");
        $data = json_decode(file_get_contents($filePath), true);
        $results = $this->importDataService->importDataFromFile($data);
        $this->commandService->printExecutionResult($results);
        return 0;
    }


}
