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

    public function getLetter($usr,$showRead) {
        // select all letter table data
        // where the current time is later than the letter lock time
        // and the current user is the adressee
        // and, based on $showRead boolean, select letter which have or haven't been read
        $stmt = $this->dbh->prepare("SELECT * from letters WHERE time < :time AND username = :username AND read = :showRead");
        // get system time in seconds since unix epoch
        $time = time();
        $stmt->bindValue(":time",$time);
        $stmt->bindValue(":username",$usr);
        $stmt->bindValue(":showRead",$showRead);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Addressed To: " . $row["username"] . "<br>";
            echo $row["letterContent"] . "<br>";
            echo "=================<br>";
        }
        // after displaying unread letter records, UPDATE is used to mark them as read 
        $stmt = $this->dbh->prepare("UPDATE letters SET read = 'True' WHERE time < :time AND username = :username AND read = :showRead");
        $stmt->bindValue(":time",$time);
        $stmt->bindValue(":username",$usr);
        $stmt->bindValue(":showRead",$showRead);
        $stmt->execute();
    }

    public function sendLetter($usr,$content) {
        // TODO: allow a third field which sets a 'date' when a letter can be opened
        // take the usr and content parameters and insert this data into the letters table
        $sql = "INSERT INTO letters(username, letterContent) VALUES(:usr,:content)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":usr", $usr);
        $stmt->bindValue(":content", $content);
        $stmt->execute();
    }

    public function addressExists($usr) {
        // query database for the given user
        $query = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(':username', $usr);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        // returns true if at least 1 match is found in db
        return $count > 0;
    }
}