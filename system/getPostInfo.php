<?php

class Post
{
    public readonly string $id;

    public function __construct(
        private readonly mysqli $connection
    ) {
        $this->getPostInfo();
    }

    private function getPostInfo()
    {
    }
}
