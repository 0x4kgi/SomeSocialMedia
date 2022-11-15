<?php

class UserDAO extends BaseDAO
{
    protected function fetchById(string $id): ?User
    {
        $sql = 'SELECT * FROM `users` WHERE `user_id`=?';

        return $this->fetch($sql, [$id], User::class);
    }

    protected function fetchByUsername(string $username): ?User
    {
        $sql = 'SELECT * FROM `users` WHERE `username`=?';

        return $this->fetch($sql, [$username], User::class);
    }

    protected function fetchByEmail(string $email): ?User
    {
        $sql = 'SELECT * FROM `users` WHERE `email`=?';

        return $this->fetch($sql, [$email], User::class);
    }

    protected function fetchAllUsers(): array
    {
        $sql = 'SELECT * FROM `users`';

        return $this->fetchAll($sql, [], User::class);
    }

    protected function add(User $user): bool
    {
        $sql = <<<SQL
            INSERT INTO `users` (
                `username`, `email`, `password`, `display_name`, `bio`, `avatar`
            ) VALUES (
                :username, :email, :password, :display_name, :bio, :avatar
            )
        SQL;

        $data = [
            ':username' => $user->getUsername(),
            ':email' => $user->getUsername(),
            ':password' => $user->getUsername(),
            ':display_name' => $user->getUsername(),
            ':bio' => $user->getUsername(),
            ':avatar' => $user->getUsername(),
        ];

        return $this->write($sql, $data);
    }

    protected function update(User $user): bool
    {
        $sql = <<<SQL
            UPDATE `users`
            SET
                `username`=:username,
                `email`=:email, 
                `password`=:password, 
                `display_name`=:display_name, 
                `bio`=:bio, 
                `avatar`=:avatar,
                `dateUpdated`=:dateUpdated
            WHERE `user_id`=:id
        SQL;

        $data = [
            ':id' => $user->getUserId(),
            ':username' => $user->getUsername(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':display_name' => $user->getDisplayName(),
            ':bio' => $user->getBio(),
            ':avatar' => $user->getAvatar(),
            ':dateUpdated' => $this->dateNow(),
        ];

        return $this->write($sql, $data);
    }

    protected function delete(User $user): bool
    {
        $sql = <<<SQL
            UPDATE `users`
            SET
                `username`=:username,
                `email`=:email, 
                `password`=:password, 
                `display_name`=:display_name, 
                `bio`=:bio, 
                `avatar`=:avatar,
                `dateUpdated`=:dateUpdated,
                `dateDeleted`=:dateDeleted,
            WHERE `user_id`=:id
        SQL;

        $data = [
            ':id' => $user->getUserId(),
            ':username' => "[DELETED-{$user->getUserId()}]",
            ':email' => "[DELETED]",
            ':password' => "[DELETED]",
            ':display_name' => "[DELETED-{$user->getUserId()}]",
            ':bio' => null,
            ':avatar' => null,
            ':dateUpdated' => $this->dateNow(),
            ':dateDeleted' => $this->dateNow(),
        ];

        return $this->write($sql, $data);
    }
}
