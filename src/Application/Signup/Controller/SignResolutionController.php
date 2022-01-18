<?php

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Application\Signup\Controller;

use Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup\OtherSigneesRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

#[Route(path: '/sign-resolution', name: 'sign-resolution')]
final class SignResolutionController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly RouterInterface $router,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return new RedirectResponse(
            $this->router->generate('show-resolution')
        );
    }

    private function parseRequestData(Request $request): Signup
    {
        /** @var Signup $signup */
        $signup = $this->formFactory->create(
            type: SignupType::class,
        )->handleRequest(
            $request
        )->getData();

        return $signup;
    }
}
