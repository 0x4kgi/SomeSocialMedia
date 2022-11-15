<?php

class CommentDAO extends BaseDAO
{
    protected function fetchById(string $id): ?Comment
    {
        $sql = 'SELECT * FROM `comments` WHERE `comment_id`=?';

        return $this->fetch($sql, [$id], Comment::class);
    }

    protected function fetchAllComments(): array
    {
        $sql = 'SELECT * FROM `comments`';

        return $this->fetchAll($sql, [], Comment::class);
    }

    protected function add(Comment $comment): bool
    {
        $sql = <<<SQL
            INSERT INTO `comments` (
            ) VALUES (
            )
        SQL;

        $data = [];

        return $this->write($sql, $data);
    }

    protected function update(Comment $comment): bool
    {
        $sql = <<<SQL
            UPDATE ``
            SET
            WHERE
        SQL;

        $data = [];

        return $this->write($sql, $data);
    }

    protected function delete(Comment $comment): bool
    {
        $sql = <<<SQL
            UPDATE ``
            SET
            WHERE
        SQL;

        $data = [];

        return $this->write($sql, $data);
    }
}
