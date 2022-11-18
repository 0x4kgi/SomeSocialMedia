<?php
class DB
{
    private static string $host = 'localhost';
    private static string $port = '';
    private static string $user = 'root';
    private static string $pass = '';
    private static string $name = 'socialmediadb';
    private static string $charset = 'UTF-8';

    private static PDO $instance;

    public static function changeDatabase($databaseName)
    {
        self::$name = $databaseName;
    }

    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            $db_info = array(
                "host" => self::$host,
                "port" => self::$port,
                "user" => self::$user,
                "pass" => self::$pass,
                "name" => self::$name,
                "charset" => self::$charset
            );

            try {
                self::$instance = new PDO(
                    "mysql:host={$db_info['host']};port={$db_info['port']};dbname={$db_info['name']}",
                    $db_info['user'],
                    $db_info['pass']
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }

        return self::$instance;
    }
}
