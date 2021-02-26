<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\LivreCreatorRepository;
use App\Domain\User\Repository\UserCreatorRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class LivreCreator
{
    /**
     * @var LivreCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LivreCreatorRepository $repository The repository
     */
    public function __construct(LivreCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new user.
     *
     * @param array $data The form data
     *
     * @return int The new user ID
     */
    public function createLivre(array $data): int
    {
        // Input validation
        $this->validateNewUser($data);

        // Insert user
        $livreId = $this->repository->insertLivre($data);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $livreId;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateNewUser(array $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data['titre'])) {
            $errors['titre'] = 'Input required';
        }

        if (empty($data['genreId'])) {
            $errors['genreId'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
