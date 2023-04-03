<?php 
namespace App\Classes;

/**
 * Includes method that executes CRUD operation.
 * Handles exception raised while executing sql operation.
 */
trait QueryExecuter 
{
    /**
     * Inserts data based on given sql query.
     * 
     *  @param string $query 
     *     Query string for data insertion into the table.
     * 
     *  @param array $data_array 
     *     Contains data to be filled.
     * 
     *  @param object $data_array 
     *     Instance of the PDO.
     * 
     *  @return void
     */
    protected function save(string $query, array $data_array, object $pdo) {
        try {
            $result = $pdo->prepare($query);
            $execution_result = $result->execute($data_array);
            if (!$execution_result) {
                echo "Unable to execute: ". $query;
                exit;
            }
        }
        catch (\PDOException $e) {
            $this->handleSQLError($query, $e->getMessage());
        }
    }

    /**
     * Executes Selection operation based on query.
     * 
     *  @param string $query 
     *     Query string for data insertion into the table.
     * 
     *  @param array $data_array 
     *     Contains data field values.
     * 
     *  @return array
     *     Returns an array mapped by field values.
     */
    protected function select(string $query, array $data_array, object $pdo) {
        $data=[];
        try {
            $result = $pdo->prepare($query);
            $execution_result = $result->execute($data_array);
            if (!$execution_result) {
                echo "Unable to execute query.";
                exit;
            }
            $data = $result->fetch(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e) {
            $this->handleSQLError($query, $e->getMessage());
        }
        return $data;
    }

    /**
     * Handle SQL Exceptions
     * 
     *  @param string $query 
     *     SQL query string.
     * 
     *  @param string $error_message 
     *     Exception caught while query execution.
     * 
     *  @return void
     */
    private function handleSQLError(string $query, string $error_message) {
        echo '<pre>';
        echo $query;
        echo '</pre>';
        echo $error_message;
        die;
    }
}