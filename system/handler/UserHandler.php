<?php

class UserHandler extends UserDAO
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

    public function add(User $user): bool
    {
        try {
            parent::add($user);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function update(User $user): bool
    {
        try {
            parent::update($user);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function delete(User $user): bool
    {
        try {
            parent::delete($user);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function purge(User $user): bool
    {
        if (empty($user->getDateDeleted())) {
            $this->setExecutionFeedback('Cannot purge this user from the database.');
            return false;
        }

        try {
            parent::purge($user);
        } catch (Exception $e) {
            $this->setExecutionFeedback($e);
            return false;
        }

        return true;
    }

    public function getUsers(): array
    {
        return $this->fetchAllUsers();
    }

    /**
     * Gets a user, if `$fetchMode` is unspecified, it will treat `$userString`
     * as `id`
     *
     * @param string $userString
     * @param string $fetchMode `id | username | email`
     * @return User|null
     */
    public function getUser($userString, $fetchMode = 'id'): ?User
    {
        switch ($fetchMode) {
            case 'username':
                return $this->fetchByUsername($userString);
            case 'email':
                return $this->fetchByEmail($userString);
            case 'id':
                return $this->fetchById($userString);
            default:
                return null;
        }
    }

    public function isPasswordMatch(string $password, User $user): bool
    {
        return password_verify($password, $user->getPassword());
    }
}
