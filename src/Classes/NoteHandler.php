<?php 
namespace APP\Classes;

use App\Classes\NotepadDB;
use App\Classes\UserDB;
use App\Classes\Register;

/**
 * Handles user registration
 */
class NoteHandler extends NotepadDB
{
    /**
     * @var array $noteData;
     *    Stores note's details fetched from form submission.
     */
    private $noteData = [];

    /**
     * @var array $authorID;
     *    Stores author's ID.
     */
    private $authorID = null;

    /**
     * Initializes class variables.
     * 
     *   @param array $userData
     *     Stores user's details fetched from form submission
     */
    public function __construct(array $noteData)
    {
        $this->noteData = $noteData;
        
        session_start();
        $email = base64_decode($_SESSION['user']);
        $register = new Register([]);
        $this->authorID = $register->getUserID($email);

        print_r($this->noteData);
        parent::__construct();
    }

    /**
     * Returns all the notes of current user.
     * 
     *   @return array
     *     Returns notes list.
     */
    public function getNotes() {
        return $this->selectNotes($this->authorID);
    }

    /**
     * Returns a single note from the database.
     * 
     *   @return array
     *     Returns note.
     */
    public function getNote() {
        return $this->selectNote($this->noteData['note_id']);
    }

    /**
     * Updates a note.
     * 
     *   @return void
     */
    public function update() {
        $this->updateNote($this->noteData['note_id'], $this->noteData['title'], $this->noteData['text']);
    }

    /**
     * Deletes the note.
     * 
     *   @return void
     */
    public function delete() {
        $this->deleteNote($this->noteData['note_id']);
    }

    /**
     * adds the new note.
     * 
     *   @return void
     */
    public function addNote() {
        $this->insertNote($this->authorID, $this->noteData['title'], $this->noteData['text']);
    }
}