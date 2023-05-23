<?php 
require_once('Database.php');

class Depense extends Database
{
    public function listDepenses()
    {
        return $this->executeQuery("SELECT * FROM `depenses` ORDER BY id DESC"); 
    }
        
    public function calculeSolde()
    {
        $depenses = $this->executeQuery("SELECT * FROM `depenses`");
        $total = 0;

        if($depenses){
            foreach($depenses as $depense){
                $total += $depense['prix'];
            }
        }
        $total = intval($total);
        return $total;
    }

    public function addDepense($formData){
        $values = array_values($formData);
        $insert = $this->executeQuery("INSERT INTO `depenses`(titre, prix) VALUES (?,?)",$values);
        if($insert){
            return true;
        }return false;
    }


    public function getDepense($id){
        $depense = $this->executeQuery("SELECT * FROM `depenses` WHERE id = ?",[$id]);
        return $depense->fetch();
    }


    public function updateDepense($formData, $id){
   
        $values = array_values($formData);
        $update = $this->executeQuery("UPDATE `depenses` SET titre = ?, prix = ? WHERE id = $id",$values);
        if($update){
            return true;
        }return false;
    }


    public function deleteDepense($id){
        $delete = $this->executeQuery("DELETE FROM `depenses` WHERE id = ?",[$id]);
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
