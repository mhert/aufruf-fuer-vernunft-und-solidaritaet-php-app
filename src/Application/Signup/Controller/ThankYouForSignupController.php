<?php

declare(strict_types=1);

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Application\Signup\Controller;

use Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup\Signup;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment as TwigEnvironment;

#[Route(path: '/thank-you', name: 'thank-you')]
final class ThankYouForSignupController
{
    public function __construct(
        private readonly TwigEnvironment $twig,
        private readonly FormFactoryInterface $formFactory,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $signup = new Signup();

        return new Response(
            $this->twig->render(
                'base.html.twig',
                [
                    'body' => $this->twig->render('views/signup/thank-you-for-signup.html.twig', [
                        'form' => $this->formFactory->create(
                            SignupType::class,
                            null,
                            ['action' => '/unterzeichnen']
                        )->createView(),
                        'signup' => $signup,
                    ]),
                    'title' => '',
                ]
            )
        );
    }
}
