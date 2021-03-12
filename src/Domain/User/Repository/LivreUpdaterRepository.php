<?php


namespace App\Domain\User\Repository;

use PDO;

final class LivreUpdaterRepository
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
    public function updateLivre(array $livre): int
    {
        $row = [
            'id' => $livre['id'],
            'titre' => $livre['titre'],
        ];

        $sql = "UPDATE livres
            SET titre=:titre
            WHERE id=:id;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}