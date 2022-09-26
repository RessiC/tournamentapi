<?php

namespace App\Command;

use App\Entity\User;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:create-user', description: 'Creates a new user.', aliases: ['app:add-user'], hidden: false)]
class CreateUserCommand extends Command
{

    protected static string $defaultDescription = 'Creates a new user.';

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'email of user')
            ->addArgument('password', InputArgument::REQUIRED, 'password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $user->setEmail($input->getArgument('email'));
        $user->setPassword($input->getArgument('password'));

        $output->writeln([
            'User creator',
            'user mail: ' . $user->getEmail(),
            'user password: ' . $user->getPassword(),
        ]);

        return Command::SUCCESS;
    }
}