<?php

class CommentHandler extends CommentDAO
{
    private $executionFeedback;

    public function getExecutionFeedback(): string
    {
        return $this->executionFeedback;
    }

    private function setExecutionFeedback(string $executionFeedback): void
    {
        $this->executionFeedback = $executionFeedback;
    }

    public function add(Comment $comment): bool
    {
        try {
            parent::add($comment);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function update(Comment $comment): bool
    {
        try {
            parent::update($comment);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function delete(Comment $comment): bool
    {
        try {
            parent::delete($comment);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function purge(Comment $comment): bool
    {
        if (empty($comment->getDateDeleted())) {
            $this->setExecutionFeedback('Cannot purge this comment from the database.');
            return false;
        }

        try {
            parent::purge($comment);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function getAllComments(): array
    {
        return $this->fetchAllComments();
    }

    public function getAllCommentsByPost(Post $post): array
    {
        return $this->fetchAllCommentsByPost($post->getPostId());
    }

    public function getAllCommentsByUser(User $user): array
    {
        return $this->fetchAllCommentsByUser($user->getUserId());
    }

    /**
     * Gets a comment, if `$fetchMode` is unspecified, it will treat `$commentString`
     * as `id`
     *
     * @param string $commentString
     * @param string $fetchMode `id | user | post`
     * @return Comment|null
     */
    public function getComment($commentId): ?Comment
    {
        return $this->fetchById($commentId);
    }
}
