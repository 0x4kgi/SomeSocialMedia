<?php

class PostHandler extends PostDAO
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

    public function add(Post $post): bool
    {
        try {
            parent::add($post);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function update(Post $post): bool
    {
        try {
            parent::update($post);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function delete(Post $post): bool
    {
        try {
            parent::delete($post);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function purge(Post $post): bool
    {
        if (empty($post->getDateDeleted())) {
            $this->setExecutionFeedback('Cannot purge this post from the database.');
            return false;
        }

        try {
            parent::purge($post);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function getPosts(): array
    {
        return $this->fetchAllPosts();
    }

    public function getPostsByUser(User $user): array
    {
        return $this->fetchAllPostsByUser($user->getUserId());
    }

    /**
     * Gets a post, if `$fetchMode` is unspecified, it will treat `$postString`
     * as `id`
     *
     * @param string $postString
     * @param string $fetchMode `id | user_id `
     * @return Post|null
     */
    public function getPost($postString, $fetchMode = 'id'): ?Post
    {
        switch ($fetchMode) {
            case 'id':
                return $this->fetchById($postString);
            case 'user':
                return $this->fetchByUser($postString);
            default:
                return null;
        }
    }
}
