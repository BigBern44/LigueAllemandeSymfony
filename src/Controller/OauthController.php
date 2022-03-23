<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class OauthController extends AbstractController
{

    /**
     * @Route("/connect/discord", name="discord_connect")
     */
    public function connectByDiscord(ClientRegistry $clientRegistry):RedirectResponse
    {

        $client = $clientRegistry->getClient('discord');

        return $client->redirect(['identify', 'email']);

    }
}

