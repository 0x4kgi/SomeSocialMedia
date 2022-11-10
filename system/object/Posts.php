<?php
class Posts
{
    private $sql;
    public array $posts;

    public function __construct(
        private mysqli $connection
    ) {
        $this->sql = "SELECT post_id FROM posts";

        return $this;
    }

    public function setUser(string $username)
    {
        $this->sql .= " WHERE username={$username}";
        return $this;
    }

    public function setOrder(bool $isLatestFirst)
    {
        $order = $isLatestFirst ? 'desc' : 'asc';
        $this->sql .= " ORDER BY post_date {$order}";
        return $this;
    }

    public function getPosts(): array
    {
        $query = mysqli_query($this->connection, $this->sql);
        while ($row = mysqli_fetch_assoc($query)) {
            $this->posts[] = new Post($this->connection, $row['post_id']);
        }

        return $this->posts;
    }
}
