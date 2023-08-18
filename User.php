<?php

class User
{
    private $dbh;

    private $usersTableName = 'users';
    private $lettersTableName = 'letters';

    public function __construct($database, $host, $databaseUsername, $databaseUserPassword)
    {
        try {
            $dsn = "mysql:host=$host;dbname=$database;charset=utf8";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            $this->dbh =
                new PDO($dsn, 
                    $databaseUsername,
                    $databaseUserPassword,
                    $options
                );

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function create($username, $password)
    {

        $statement = $this->dbh->prepare(
            'INSERT INTO '.$this->usersTableName.' (username, password) VALUES (:username, :password)'
        );

        if (false === $statement) {
            throw new Exception('Invalid prepare statement');
        }

        if (false === $statement->execute([
                ':username' => $username,
                ':password' => $password,
            ])) {
            throw new Exception(implode(' ', $statement->errorInfo()));
        }
    }

    public function exists($username, $password)
    {
        $statement = $this->dbh->prepare(
            'SELECT * from '.$this->usersTableName.' where username = :username'
        );

        if (false === $statement) {
            throw new Exception('Invalid prepare statement');
        }

        $result = $statement->execute([':username' => $username]);

        if (false === $result) {
            throw new Exception(implode(' ', $statement->errorInfo()));
        }

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!is_array($row)) {
            return false;
        }

        return ($password === $row['password']);
    }

    public function getLetter()
    {
        $stmt = $this->dbh->query("SELECT * from letters");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "username" . $row["username"] . "<br>";
            echo "letterContent" . $row["letterContent"] . "<br>";
        }
    }
}