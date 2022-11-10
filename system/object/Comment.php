<?php

class Comment
{
    public function __construct(
        public readonly string $id,
        public readonly string $postId,
        public readonly User $submitter,
        public readonly string $comment,
        public readonly string $date,
    ) {
    }
}
