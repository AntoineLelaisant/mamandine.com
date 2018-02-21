<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\CakeRepository;
use Twig\Environment;
use Symfony\Component\Console\Question\Question;

class SendCakesCommand extends Command
{
    private $cakeRepository;
    private $mailer;
    private $twig;

    private $cakes = [];
    private $recipient = null;

    public function __construct(
        CakeRepository $cakeRepository,
        \Swift_Mailer $mailer,
        Environment $twig
    ) {
        parent::__construct();

        $this->cakeRepository = $cakeRepository;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function configure()
    {
        $this
            ->setName('app:send:cakes')
            ->setDescription('Send cakes by email.')
        ;
    }

    public function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->cakes = $this->cakeRepository->findAll();
    }

    public function interact(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $this->recipient = $io->askQuestion(new Question('Recipient ?'));
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $io->text('Preparing cakes');

        $io->progressStart(count($this->cakes));
        foreach ($this->cakes as $cake) {
            $cake->prepare();
            $io->progressAdvance();
        }
        $io->progressFinish();

        $io->text(sprintf('Sending email to %s', $this->recipient));
        $mailContent = $this->twig->render('email/cakes.html.twig', [
            'cakes' => $this->cakes,
            'recipient' => $this->recipient,
        ]);

        $message = (new \Swift_Message('List of cakes'))
            ->setFrom(['noreply@mamamdine.com' => 'Mamandine.com'])
            ->setTo($this->recipient)
            ->setBody($mailContent)
        ;

        $this->mailer->send($message);

        $io->success('Email successfully sent !');
    }
}
