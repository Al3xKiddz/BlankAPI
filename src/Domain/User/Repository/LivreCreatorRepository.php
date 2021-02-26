<?php


namespace App\Domain\User\Repository;

use PDO;

final class LivreCreatorRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insert user row.
     *
     * @param array $user The user
     *
     * @return int The new ID
     */
    public function insertLivre(array $livre): int
    {
        $row = [
            'titre' => $livre['titre'],
            'genreId' => $livre['genreId'],
        ];

        $sql = "INSERT INTO livres SET 
                titre=:titre, 
                genreId=:genreId;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}