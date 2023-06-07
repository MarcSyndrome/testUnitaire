<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests Version Yannis
 * Remodulé pour que ca tourne, pas pour que ce soit logique ^^ 
 */
class AuthentificationTest extends WebTestCase
{
    /**
     * @dataProvider provideLogin
     */
    public function testLogin($login, $email, $pwd, $assert)
    {
        // Create a client to browse the application
        $client = static::createClient([], ['debug' => true]);

        // Simulate a login
        $crawler = $client->request('GET', '/contact');

        $form = $crawler->selectButton('Submit')->form([
            'contact[name]' => $login,
            'contact[email]' => $email,
            'contact[password]' => $pwd,
        ]);

        $client->submit($form);
        // $client->followRedirect();

        // Check if the login was successful
        $this->assertEquals($assert, $client->getResponse()->getStatusCode(), 'Erreur de connexion pour le login ' . $login . ' et le mot de passe ' . $pwd . "\n" . 'Code HTTP : ' . $client->getResponse()->getStatusCode() . "\n" . 'Code attendu : ' . $assert);
    }
    public function provideLogin()
    {
        return [
            ["test", "pouet@test.com", "azerty", "302"],
            ["test", "pouet@test.com", "", "302"],
            ["", "pouet@test.com", "azerty", "500"],
            ["", "pouet@test.com", "", "500"],
            [null, "pouet@test.com", null, "500"]
        ];
    }
}
