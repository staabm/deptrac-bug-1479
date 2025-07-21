<?php

declare(strict_types=1);

namespace Deptrac\Deptrac\Supportive\Console\Command;

use Deptrac\Deptrac\Supportive\Console\Symfony\Style;
use Deptrac\Deptrac\Supportive\Console\Symfony\SymfonyOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DebugUnusedCommand extends Command
{
    public static $defaultName = 'debug:unused';
    public static $defaultDescription = 'Lists unused (or barely used) layer dependencies';

    public function __construct(private readonly DebugUnusedRunner $runner)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        parent::configure();

        $this->addOption(
            'limit',
            'l',
            InputOption::VALUE_OPTIONAL,
            'How many times can it be used to be considered unused',
            0
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $outputStyle = new Style(new SymfonyStyle($input, $output));
        $symfonyOutput = new SymfonyOutput($output, $outputStyle);

        try {
            /** @var string $limit */
            $limit = $input->getOption('limit');
            $this->runner->run($symfonyOutput, (int) $limit);
        } catch (CommandRunException $exception) {
            $outputStyle->error($exception->getMessage());

            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
