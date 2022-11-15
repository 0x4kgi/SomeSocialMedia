<?php
class DB
{
    private static PDO $instance;

    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            $db_info = array(
                // This should not be hardcoded.
                "host" => "localhost",
                "port" => "",
                "user" => "root",
                "pass" => "",
                "name" => "socialmediadb",
                "charset" => "UTF-8"
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
