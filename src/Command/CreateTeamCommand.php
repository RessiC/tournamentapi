<?php

namespace App\Command;

use App\Entity\Team\Team;
use App\Entity\User\User;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Persistence\ManagerRegistry;

#[AsCommand(name: 'app:create-team', description: 'Creates a new team.', aliases: ['app:add-team'], hidden: false)]
class CreateTeamCommand extends Command
{

    protected static string $defaultDescription = 'Creates a new team.';

    private ManagerRegistry $managerRegistry;

    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
        parent::__construct();

    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'name of team');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $team = new Team();
        $user1 = new User();
        $user2 = new User();
        $user1->setEmail('emailuser1@gmail.com');
        $user1->setPassword('abcde123');
        $user1->setGamerTag('gt1');

        $user2->setEmail('emailuser2@gmail.com');
        $user2->setPassword('abcde123');
        $user2->setGamerTag('gt2');

        $team->setName($input->getArgument('name'));
        $team->addPlayer($user1);
        $team->addPlayer($user2);
        $this->managerRegistry->getManager()->persist($user1);
        $this->managerRegistry->getManager()->persist($user2);
        $this->managerRegistry->getManager()->persist($team);
        $this->managerRegistry->getManager()->flush();

        return Command::SUCCESS;
    }
}