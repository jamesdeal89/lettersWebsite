<?php

class User
{
    private $dbh;

    private $usersTableName = 'users';
    private $lettersTableName = 'letters';

    public function __construct($database, $host, $databaseUsername, $databaseUserPassword) {
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
    }

    public function create($username, $password) {

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

    public function exists($username, $password) {
        // query database for the given user/pass combo
        $query = "SELECT COUNT(*) FROM users WHERE username = :username AND password = :password";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        // returns true if at least 1 match is found in db
        return $count > 0;
    }

    public function getLetter() {
        // select all letter table data
        $stmt = $this->dbh->query("SELECT * from letters");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Addressed To: " . $row["username"] . "<br>";
            echo "Letter Contents:: " . $row["letterContent"] . "<br>";
        }
    }
}