<?php

namespace App\Models;

class Message extends \App\Models\Base

{
    public function add($author_id, $text)
    {
        $sql = "INSERT INTO messages (text, created_at, author_id) VALUES (:text, :created_at, :author_id)";
        $statement = $this->getConnect()->prepare($sql);
        $result = $statement->execute(["text" => $text,
            "created_at" => date("y.m.d"),
            "author_id" => $author_id]);

        return $result;
    }

    public function getAll()
    {
        $sql = "SELECT messages.id, text, created_at, `name` FROM messages INNER JOIN users ON users.id = messages.author_id ORDER BY id DESC LIMIT 20";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getLastInsertId()
    {

        $sql = "SELECT id FROM `messages` ORDER BY id DESC LIMIT 1";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC)["id"] +1;

    }


    public function getAllById($id)
    {
        $sql = "SELECT text FROM `messages` WHERE author_id=:author_id";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute(["author_id" => $id]);
        return json_encode($statement->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function delete($id)
    {
        $sql = "DELETE FROM messages WHERE id=:id";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute(["id" => $id]);
        return $statement->rowCount();
    }


}



