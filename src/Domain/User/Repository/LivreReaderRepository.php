<?php


namespace App\Domain\User\Repository;


use PDO;

class LivreReaderRepository
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
    public function readLivre(): array
    {
        $sql = "SELECT * FROM livres;";
        $oof = $this->connection->query($sql);
        return (array)$oof->fetchAll();
    }
}