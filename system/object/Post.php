<?php

class Post extends BaseObject
{
    private string $post_id;
    private string $content;
    private string $user_id;
    private string $rating;

    /**
     * Get the value of post_id
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the value of rating
     */
    public function getRating()
    {
        return $this->rating;
    }
}
