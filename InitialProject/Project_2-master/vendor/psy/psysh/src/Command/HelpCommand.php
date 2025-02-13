<?php

/*
 * This file is part of Psy Shell.
 *
<<<<<<< HEAD
 * (c) 2012-2022 Justin Hileman
=======
 * (c) 2012-2023 Justin Hileman
>>>>>>> main
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Command;

use Psy\Output\ShellOutput;
<<<<<<< HEAD
use Symfony\Component\Console\Helper\TableHelper;
=======
>>>>>>> main
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Help command.
 *
 * Lists available commands, and gives command-specific help when asked nicely.
 */
class HelpCommand extends Command
{
<<<<<<< HEAD
    private $command;
=======
    private ?Command $command = null;
>>>>>>> main

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('help')
            ->setAliases(['?'])
            ->setDefinition([
                new InputArgument('command_name', InputArgument::OPTIONAL, 'The command name.', null),
            ])
            ->setDescription('Show a list of commands. Type `help [foo]` for information about [foo].')
            ->setHelp('My. How meta.');
    }

    /**
     * Helper for setting a subcommand to retrieve help for.
     *
     * @param Command $command
     */
    public function setCommand(Command $command)
    {
        $this->command = $command;
    }

    /**
     * {@inheritdoc}
<<<<<<< HEAD
     */
    protected function execute(InputInterface $input, OutputInterface $output)
=======
     *
     * @return int 0 if everything went fine, or an exit code
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
>>>>>>> main
    {
        if ($this->command !== null) {
            // help for an individual command
            $output->page($this->command->asText());
            $this->command = null;
        } elseif ($name = $input->getArgument('command_name')) {
            // help for an individual command
            $output->page($this->getApplication()->get($name)->asText());
        } else {
            // list available commands
            $commands = $this->getApplication()->all();

            $table = $this->getTable($output);

            foreach ($commands as $name => $command) {
                if ($name !== $command->getName()) {
                    continue;
                }

                if ($command->getAliases()) {
                    $aliases = \sprintf('<comment>Aliases:</comment> %s', \implode(', ', $command->getAliases()));
                } else {
                    $aliases = '';
                }

                $table->addRow([
                    \sprintf('<info>%s</info>', $name),
                    $command->getDescription(),
                    $aliases,
                ]);
            }

            if ($output instanceof ShellOutput) {
                $output->startPaging();
            }

<<<<<<< HEAD
            if ($table instanceof TableHelper) {
                $table->render($output);
            } else {
                $table->render();
            }
=======
            $table->render();
>>>>>>> main

            if ($output instanceof ShellOutput) {
                $output->stopPaging();
            }
        }

        return 0;
    }
}
