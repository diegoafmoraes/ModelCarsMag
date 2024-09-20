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
