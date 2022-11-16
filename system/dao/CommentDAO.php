<?php

class CommentDAO extends BaseDAO
{
    protected function fetchById(string $id): ?Comment
    {
        $sql = 'SELECT * FROM `comments` WHERE `comment_id`=?';

        return $this->fetch($sql, [$id], Comment::class);
    }

    protected function fetchAllCommentsByPost($postId): array
    {
        $sql = 'SELECT * FROM `comments` WHERE `post_id`=?';

        return $this->fetchAll($sql, [$postId], Comment::class);
    }

    protected function fetchAllCommentsByUser($userId): array
    {
        $sql = 'SELECT * FROM `comments` WHERE `user_id`=?';

        return $this->fetchAll($sql, [$userId], Comment::class);
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
                `post_id`, `user_id`, `content`
            ) VALUES (
                :postId, :userId, :content
            )
        SQL;

        $data = [
            ':postId' => $comment->getPostId(),
            ':userId' => $comment->getUserId(),
            ':content' => $comment->getContent(),
        ];

        return $this->run($sql, $data);
    }

    protected function update(Comment $comment): bool
    {
        $sql = <<<SQL
            UPDATE `comments`
            SET
                `content`=:content
            WHERE
                `post_id`=:postId AND `comment_id`=:commentId
        SQL;

        $data = [
            ':postId' => $comment->getPostId(),
            ':commentId' => $comment->getCommentId(),
            ':content' => $comment->getContent(),
        ];

        return $this->run($sql, $data);
    }

    protected function delete(Comment $comment): bool
    {
        $sql = <<<SQL
            UPDATE `comments`
            SET
                `content`=:content,
                `user_id`=:userId
            WHERE
                `post_id`=:postId AND `comment_id`=:commentId
        SQL;

        $data = [
            `:userId` => null,
            ':postId' => $comment->getPostId(),
            ':commentId' => $comment->getCommentId(),
            ':content' => '[ DELETED ]',
        ];

        return $this->run($sql, $data);
    }

    protected function purge(Comment $comment): bool
    {
        $sql = <<<SQL
            DELETE FROM `comments`
            WHERE
                `comment_id`=? 
        SQL;

        $data = [
            $comment->getCommentId(),
        ];

        return $this->run($sql, $data);
    }
}
