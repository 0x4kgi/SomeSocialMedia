<?php

class CommentDAO extends BaseDAO
{
    protected function fetchById(string $id): ?Post
    {
        $sql = 'SELECT * FROM `posts` WHERE `post_id`=?';

        return $this->fetch($sql, [$id], Post::class);
    }

    protected function fetchAllComments(): array
    {
        $sql = 'SELECT * FROM `posts`';

        return $this->fetchAll($sql, [], Post::class);
    }

    protected function add(Post $post): bool
    {
        $sql = <<<SQL
            INSERT INTO `posts` (
            ) VALUES (
            )
        SQL;

        $data = [];

        return $this->write($sql, $data);
    }

    protected function update(Post $post): bool
    {
        $sql = <<<SQL
            UPDATE ``
            SET
            WHERE
        SQL;

        $data = [];

        return $this->write($sql, $data);
    }

    protected function delete(Post $post): bool
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
