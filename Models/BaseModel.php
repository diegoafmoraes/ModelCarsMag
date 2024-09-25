<?php

namespace Models;

use \Core\Model;
use \PDOException;

/**
 * Base Model that provides fundamental database operations.
 */
class BaseModel extends Model
{
    /**
     * Constructor to initialize the model.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fetch a single record from the database.
     *
     * @param \PDOStatement $sql The prepared statement.
     * @return object|null The fetched object or null in case of an error.
     */
    public function fetch($sql)
    {
        try {
            return $sql->fetch(\PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            // Log the error internally.
            error_log('Fetch Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Fetch all records from the database.
     *
     * @param \PDOStatement $sql The prepared statement.
     * @return array An array of fetched objects or an empty array in case of an error.
     */
    public function fetchAll($sql)
    {
        try {
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            // Log the error internally.
            error_log('Fetch All Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Generate a complex hash from a given parameter.
     * @param mixed $param The parameter to hash.
     * @return string The generated hash.
     */
    protected function geraHash($param)
    {
        $p1 = md5($param);
        $p2 = sha1($param);
        $p3 = uniqid($param);
        $interval = rand(0, 98765432);

        $str = $p1 . $interval . $p2 . $interval . $p3;

        return substr($str, 0, 198);
    }

    /**
     * Generate secure password
     *
     * @param [type] $password
     * @return void
     */
    protected function genPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Debugger
     *
     * @param [type] $arr
     * @return void
     */
    public static function dd($arr)
    {

        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        exit;
    }
}
