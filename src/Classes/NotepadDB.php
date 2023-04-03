<?php
namespace App\Classes;

use App\Classes\QueryExecuter;

/**
 * Performs Data insertion, selection and updation for User table.
 */
class NotepadDB extends DBConnector
{
    /**
     *  @var $pdo
     *     Instance of PDO class;
     */
    protected $pdo;

    /**
     * Extending QueryExecuter trait.
     */
    use QueryExecuter;

    
    /** 
     * Initializes $pdo (instance of PDO) when instance of the class is created.
     */
    public function __construct() {
        $this->pdo = $this->connectDB();
    }
    
    /**
     * Inserts user data into the user table.
     * 
     *  @param string $authorID
     *     user id of the author.
     *     
     *  @param string $title
     *     Title of the note.
     *     
     *  @param string $text
     *     Content of the Note.
     */
    protected function insertNote(int $authorID, string $title, string $text) {
        $query = "INSERT INTO notepad (author_id, title, text, create_time) VALUES (?, ?, ?, now())";
        $data_array = [$authorID, $title, $text];
        $this->save($query, $data_array, $this->pdo);
    }

    /**
     * Selects a note from database.
     * 
     *  @param string $id 
     *    Note id.
     * 
     *  @return array
     *   Returns note.
     */
    protected function selectNote(string $id) {
        $query = "SELECT id, title, text FROM notepad WHERE id = ? ORDER BY create_time DESC";
        $data_array = [$id];
        return $this->select($query, $data_array, $this->pdo);
    }

    /**
     * Selects user's notes from notepad table.
     * 
     *  @param int $authorID.
     *    author Id.
     * 
     *  @return array
     *   Returns notes.
     */
    protected function selectNotes(int $authorID) {
        $query = "SELECT id, title, text FROM notepad WHERE author_id = ? ORDER BY create_time DESC";
        $data_array = [$authorID];
        return $this->select($query, $data_array, $this->pdo);
    }

    /**
     * updates a note into database.
     * 
     *  @param string $id 
     *    Note id.
     * 
     *  @param string $title
     *     Title of the note.
     *     
     *  @param string $text
     *     Content of the Note.
     * 
     *  @return void
     */
    protected function updateNote(string $title, string $text, int $id) {
        $query = "UPDATE notepad set title = ?, text = ? WHERE id = ?";
        $data_array = [$title, $text, $id];
        $this->save($query, $data_array, $this->pdo);
    }
    
    /**
     * deletes a note from database.
     * 
     *  @param string $id 
     *    Note id.
     * 
     *  @return void
     */
    protected function deleteNote(int $id) {
        $query = "DELETE FROM notepad WHERE id = ?";
        $data_array = [$id];
        $this->save($query, $data_array, $this->pdo);
    }
}