<?php
class User
{
    public readonly string $user_id;
    public readonly string $email;
    public readonly string $display_name;
    public readonly string $join_date;
    public readonly string $bio;
    public readonly string $profile_picture;

    public function __construct(
        private readonly mysqli $connection,
        public readonly string $username,
    ) {
        $this->getUserInfo();
    }

    private function getUserInfo()
    {
        $query = "SELECT * FROM `users` WHERE `username`='" . $this->username . "'";
        $row = mysqli_query($this->connection, $query);
        $result = mysqli_fetch_assoc($row);

        $this->user_id = $result['user_id'];
        $this->email = $result['email'];
        $this->display_name = $result['display_name'] ?? $this->username;
        $this->join_date = $result['join_date'];
        $this->bio = $result['prof_bio'] ?? "no bio";
        $this->profile_picture = $result['prof_pic'] ?? "assets/noimg.jpg";
    }

    public function getPostCount(): int
    {
        $query = "SELECT COUNT(post_id) AS postCTR FROM posts WHERE submittedby='" . $this->username . "'";
        $row = mysqli_query($this->connection, $query);
        $result = mysqli_fetch_assoc($row);

        return $result["postCTR"];
    }

    public function getCommentCount(): int
    {
        $query = "SELECT COUNT(comment_id) AS commentCTR FROM comments WHERE submittedby='" . $this->username . "'";
        $row = mysqli_query($this->connection, $query);
        $result = mysqli_fetch_assoc($row);

        return $result["commentCTR"];
    }
}
