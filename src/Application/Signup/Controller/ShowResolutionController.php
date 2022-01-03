<?php

declare(strict_types=1);

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Application\Signup\Controller;

use Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup\Signup;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment as TwigEnvironment;

#[Route(path: '/', name: 'show-resolution')]
final class ShowResolutionController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly RouterInterface $router,
        private readonly TwigEnvironment $twig,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $signup = new Signup();

        return new Response(
            $this->twig->render(
                'base.html.twig',
                [
                    'body' => $this->twig->render('views/signup/show-resolution.html.twig', [
                        'form' => $this->createForm(),
                        'signup' => $signup,
                    ]),
                    'title' => '',
                ]
            )
        );
    }

    public function createForm(): FormView
    {
        return $this->formFactory->create(
            SignupType::class,
            null,
            [
                'action' => $this->router->generate('sign-resolution'),
            ]
        )->createView();
    }
}
