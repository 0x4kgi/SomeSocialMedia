<?php

class PostDAO extends BaseDAO
{
    protected function fetchById(string $id): ?Post
    {
        $sql = 'SELECT * FROM `posts` WHERE `post_id`=?';

        return $this->fetch($sql, [$id], Post::class);
    }

    protected function fetchByUser(string $id): ?Post
    {
        $sql = 'SELECT * FROM `posts` WHERE `user_id`=?';

        return $this->fetch($sql, [$id], Post::class);
    }

    protected function fetchAllPosts(): array
    {
        $sql = 'SELECT * FROM `posts`';

        return $this->fetchAll($sql, [], Post::class);
    }

    protected function fetchAllPostsByUser($userId): array
    {
        $sql = 'SELECT * FROM `posts` WHERE `user_id`=?';

        return $this->fetchAll($sql, [$userId], Post::class);
    }

    protected function add(Post $post): bool
    {
        $sql = <<<SQL
            INSERT INTO `posts` (
                `content`, `user_id`, `rating`
            ) VALUES (
                :content, :user, :rating
            )
        SQL;

        $data = [
            ':content' => $post->getContent(),
            ':user' => $post->getUserId(),
            ':rating' => $post->getRating(),
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
                `dateModified`=:dateModified
            WHERE
                `post_id`=:postId AND `user_id`=:user
        SQL;

        $data = [
            ':content' => $post->getContent(),
            ':user' => $post->getUserId(),
            ':rating' => $post->getRating(),
            ':dateModified' => $this->dateNow(),
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
                `user_id`=:empty,
                `dateModified`=:dateModified,
                `dateDeleted`=:dateModified
            WHERE
                `post_id`=:postId AND `user_id`=:user
        SQL;

        $data = [
            ':content' => '[ DELETED ]',
            ':user' => $post->getUserId(),
            ':dateModified' => $this->dateNow(),
            ':postId' => $post->getPostId(),
            ':empty' => null,
        ];

        return $this->run($sql, $data);
    }

    protected function purge(Post $post): bool
    {
        $sql = <<<SQL
            DELETE FROM `posts`
            WHERE
                `post_id`=? 
        SQL;

        $data = [
            $post->getPostId(),
        ];

        return $this->run($sql, $data);
    }
}
