<?php


namespace App\Domain\User\Service;


use App\Domain\User\Repository\LivreReaderRepository;
use App\Exception\ValidationException;

class LivreReader
{
    /**
     * @var LivreReaderRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LivreReaderRepository $repository The repository
     */
    public function __construct(LivreReaderRepository $repository)
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
    public function readLivre(): array
    {
        // Input validation
        //$this->validateNewUser($data);

        // Insert user
        $livreId = $this->repository->readLivre();

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));
        //$this->validateNewUser($livreId);
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
            $errors['titre'] = 'vide';
        }

        if (empty($data['genreId'])) {
            $errors['genreId'] = 'vide';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}