<?php

abstract class BaseObject
{
    protected string $dateCreated;
    protected ?string $dateModified;
    protected ?string $dateDeleted;

    public function getDateCreated(bool $relative): string
    {
        if ($relative) {
            return Utility::TimeAgo($this->dateCreated, date("Y-m-d H:i:s"));
        }

        return $this->dateCreated;
    }

    public function getDateModified(bool $relative): string
    {
        if ($relative) {
            return Utility::TimeAgo($this->dateModified, date("Y-m-d H:i:s"));
        }

        return $this->dateModified;
    }

    public function getDateDeleted(bool $relative): string
    {
        if ($relative) {
            return Utility::TimeAgo($this->dateDeleted, date("Y-m-d H:i:s"));
        }

        return $this->dateDeleted;
    }
}
