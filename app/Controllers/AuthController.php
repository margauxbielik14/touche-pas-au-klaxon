<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Session;
use App\Repositories\UserRepository;

/**
 * Handles user authentication.
 */
class AuthController
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    /**
     * Displays the login form.
     */
    public function showLoginForm(): void
    {
        require dirname(__DIR__, 2) . '/templates/auth/login.php';
    }

    /**
     * Authenticates a user.
     */
    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->userRepository->findByEmail($email);

        if (
            $user === false
            || !password_verify($password, (string) $user['mot_de_passe'])
        ) {
            $error = 'Adresse email ou mot de passe incorrect.';

            require dirname(__DIR__, 2) . '/templates/auth/login.php';

            return;
        }

        Session::set('user', [
            'id' => $user['id_employe'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'email' => $user['email'],
            'telephone' => $user['telephone'],
            'role' => $user['role'],
        ]);

        header('Location: /');

        exit;
    }

    /**
     * Logs the current user out.
     */
    public function logout(): void
    {
        Session::destroy();

        header('Location: /');

        exit;
    }
}