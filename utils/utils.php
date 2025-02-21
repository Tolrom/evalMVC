<?php
class Utils {
    /**
 * Fonction de nettoyage de données
 *@param string $data
 *@return string la donnée nettoyée
*/
public static function sanitize($data){
    return htmlentities(strip_tags(stripslashes(trim($data))));
}

/**
 * Fonction de création de l'objet de connexion PDO
 *@return \PDO l'objet de connexion à la bdd
*/
public static function connexion(): \PDO{
    $host = $_ENV["DB_HOST"] ?? null;
    $dbname = $_ENV["DB_NAME"] ?? null;
    $username = $_ENV["DB_USER"] ?? null;
    $password = $_ENV["DB_PASS"] ?? null;
    $port = $_ENV["DB_PORT"] ?? null;
    $dsn = "mysql:host={$host};{$port}=3306;dbname={$dbname};charset=utf8mb4";
    return new \PDO(
        $dsn, $username,$password,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
}
}
