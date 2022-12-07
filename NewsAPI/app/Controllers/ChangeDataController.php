<?php


namespace App\Controllers;


use App\Database;
use App\Navigation;

class ChangeDataController
{


    public function changeData()
    {

        $oldEmail = $_POST['email'];
        $newEmail = $_POST['newEmail'];
        $reEmail = $_POST['reEmail'];
        $id = $_SESSION['id'];

        $result = Database::getConnection()->executeQuery("SELECT id, email FROM users WHERE id = '$id' " );
        $resultCheck = $result->fetchAssociative();
        if ($resultCheck['email'] == $oldEmail) {
            if ($newEmail === $reEmail) {
                if (!Database::getConnection()->executeQuery("SELECT email FROM users WHERE email = '$newEmail' ")->rowCount()) {
                    Database::getConnection()->Query("UPDATE users SET email = '$newEmail' WHERE id = '$id' ");

                }
            }
        }
        return new Navigation("/authorization");
    }


}
