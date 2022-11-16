<?php

abstract class BaseDAO
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    /**
     * Checks if the query is safe to work with
     *
     * @param string $sql
     * @param array $parameters
     * @return PDOStatement
     */
    private function sanityCheck(string $sql, array $parameters): PDOStatement
    {
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Query preparation error: " . $this->db->errorInfo()[2]);
        }

        $exec = $stmt->execute($parameters);
        if (!$exec) {
            throw new Exception("Query execution error: " . $stmt->errorInfo()[2]);
        }

        return $stmt;
    }

    /**
     * Returns the last inserted id
     *
     * @return string
     */
    public function lastInsertId(): string
    {
        return $this->db->lastInsertId();
    }

    /**
     * Returns the datetime at this current moment
     *
     * @param string $format
     * @return string
     */
    protected function dateNow(string $format = "Y-m-d H:i:s"): string
    {
        $date = new DateTime();

        return $date->format($format);
    }

    /**
     * Returns a class with the specified type 
     * with the given SQL and parameters
     *
     * @param string $sql
     * @param array $parameters
     * @param string $class use `ClassName::class`
     * @return object Class type is the $class
     */
    protected function fetch(string $sql, array $parameters, string $class, int $fetchMode = PDO::FETCH_CLASS): ?object
    {
        $stmt = $this->sanityCheck($sql, $parameters);
        if ($fetchMode === PDO::FETCH_ASSOC) {
            $stmt->setFetchMode($fetchMode);
        } else {
            $stmt->setFetchMode($fetchMode, $class);
        }

        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        return $result;
    }

    /**
     * Returns an array of classes with the specified type
     * from the given SQL query
     *
     * @param string $sql
     * @param array $parameters
     * @param string $class
     * @return array
     */
    protected function fetchAll(string $sql, array $parameters, string $class, int $fetchMode = PDO::FETCH_CLASS): array
    {
        $stmt = $this->sanityCheck($sql, $parameters);

        if ($fetchMode === PDO::FETCH_ASSOC) {
            return $stmt->fetchAll($fetchMode);
        }

        return $stmt->fetchAll($fetchMode, $class);
    }

    /**
     * A common function of the record* methods
     *
     * @param string $sql
     * @param array $parameters
     * @return bool
     */
    private function executeQuery(string $sql, array $parameters): bool
    {
        $stmt = $this->sanityCheck($sql, $parameters);
        if (!$stmt) {
            return false;
        }

        return true;
    }

    /**
     * Execute the SQL query
     *
     * @param string $sql
     * @param array $parameters
     * @return bool
     */
    protected function run(string $sql, array $parameters): bool
    {
        return $this->executeQuery($sql, $parameters);
    }

    /**
     * For queries that answers "is this x" or "does z exists".
     *
     * @param string $sql
     * @param array $parameters
     * @return bool
     */
    protected function recordCheck(string $sql, array $parameters): bool
    {
        $stmt = $this->sanityCheck($sql, $parameters);
        if (!$stmt) {
            return false;
        }

        return  (bool) $stmt->fetchColumn();
    }
}
