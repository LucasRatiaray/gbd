<?php 
require_once('Database.php');

class Task extends Database
{
    public function listTasks()
    {
        return $this->executeQuery("SELECT * FROM `tasks` ORDER BY id DESC"); 
    }

    public function addTasks($formData){
        $values = array_values($formData);
        $insert = $this->executeQuery("INSERT INTO `tasks`(name) VALUES (?)",$values);
        if($insert){
            return true;
        }return false;
    }

    public function updateTasks($formData, $id){
   
        $values = array_values($formData);
        $update = $this->executeQuery("UPDATE `tasks` SET name = ? WHERE id = $id",$values);
        if($update){
            return true;
        }return false;
    }


    public function deleteTasks($id){
        $delete = $this->executeQuery("DELETE FROM `tasks` WHERE id = ?",[$id]);
        if($delete){
            return true;
        }return false;
    }

    public static function cleaner($data){
        $data = trim($data);
        $data = htmlspecialchars($data, ENT_QUOTES);
        $data = strip_tags($data);
        return $data;
    }
}
