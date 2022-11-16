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
                `content`, `user_id`, `rating`,
            ) VALUES (
                :content, :user, :rating
            )
        SQL;

        $data = [
            $post->getContent(),
            $post->getUserId(),
            $post->getRating(),
        ];

        return $this->run($sql, $data);
    }

    protected function update(Post $post): bool
    {
        $sql = <<<SQL
            UPDATE `posts`
            SET
                `content`=:content,
                `user_id`=:user,
                `rating`=:rating,
                `dateUpdated`=:dateUpdated
            WHERE
                `post_id`=:postId AND `user_id`=:user
        SQL;

        $data = [
            ':content' => $post->getContent(),
            ':user' => $post->getUserId(),
            ':rating' => $post->getRating(),
            ':dateUpdated' => $this->dateNow(),
            ':postId' => $post->getPostId(),
        ];

        return $this->run($sql, $data);
    }

    protected function delete(Post $post): bool
    {
        $sql = <<<SQL
            UPDATE `posts`
            SET
                `content`=:content,
                `user_id`=:user,
                `rating`=:rating,
                `dateUpdated`=:dateUpdated,
                `dateDeleted`=:dateUpdated
            WHERE
                `post_id`=:postId AND `user_id`=:user
        SQL;

        $data = [
            ':content' => '[ DELETED ]',
            ':user' => null,
            ':rating' => $post->getContent(),
            ':dateUpdated' => $this->dateNow(),
            ':postId' => $post->getPostId(),
        ];

        return $this->run($sql, $data);
    }

    protected function purge(Post $post): bool
    {
        $sql = <<<SQL
            DELETE FROM `posts`
            WHERE
                `id`=? 
        SQL;

        $data = [
            $post->getPostId(),
        ];

        return $this->run($sql, $data);
    }
}
