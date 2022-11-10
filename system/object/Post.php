<?php

class Post
{
    public readonly string $postDate;
    public readonly string $content;
    public readonly User $submitter;
    public readonly string $rating;
    public array $comments = [];
    public array $participants = [];

    public function __construct(
        private readonly mysqli $connection,
        public readonly string $id,
    ) {
        $this->getPostInfo();
    }

    private function getPostInfo()
    {
        $query = "SELECT * FROM `posts` WHERE `post_id`='{$this->id}'";
        $row = mysqli_query($this->connection, $query);
        $result = mysqli_fetch_assoc($row);

        $this->postDate = $result['post_date'];
        $this->content = $result['post'];
        $this->submitter = new User($this->connection, $result['submittedby']);
        $this->rating = $result['rating'];
    }

    public function getComments(): array
    {
        $sql = "SELECT * FROM comments WHERE post_id='{$this->id}'";
        $query = mysqli_query($this->connection, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $comment = new Comment(
                $row['comment_id'],
                $row['post_id'],
                new User($this->connection, $row['submittedby']),
                $row['comment'],
                $row['comment_date'],
            );

            $this->comments[] = $comment;
        }

        return $this->comments;
    }

    public function getPostParticipants(): array
    {
        $sql = "SELECT DISTINCT submittedby FROM comments WHERE post_id='{$this->id}'";
        $query = mysqli_query($this->connection, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $this->participants[] = new User($this->connection, $row['submittedby']);;
        }


        return $this->participants;
    }
}
