<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Repositories\UserRepository;

/**
 * Handles administration pages.
 */
class AdminController
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    /**
     * Displays the administration dashboard.
     */
    public function dashboard(): void
    {
        Auth::requireAdmin();

        require dirname(__DIR__, 2)
            . '/templates/admin/dashboard.php';
    }

    /**
     * Displays all employees.
     */
    public function users(): void
    {
        Auth::requireAdmin();

        $users = $this->userRepository->findAll();

        require dirname(__DIR__, 2)
            . '/templates/admin/users.php';
    }
}