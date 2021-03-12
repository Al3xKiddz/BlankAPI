<?php


namespace App\Domain\User\Repository;


use PDO;

class LivreDeleterRepository
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
    public function deleteLivre(array $data): int
    {
        $row = [
            'titre' => $data['titre'],
        ];

        $sql = "DELETE FROM livres
                WHERE titre=:titre;";

        $this->connection->prepare($sql)->execute($row);

        return 1;
    }
}