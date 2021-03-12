<?php


namespace App\Domain\User\Repository;


use PDO;

class LivreReader1Repository
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
    public function readLivre($data): array
    {
        $sql = "SELECT * FROM livres
                WHERE id=:id;";

        $oof = $this->connection->prepare($sql);
        $oof->execute(['id' => $data['id']]);
        return (array)$oof->fetch();
    }
}