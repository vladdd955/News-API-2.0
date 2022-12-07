<?php


namespace App\Controllers;


use App\Database;
use App\Navigation;


class ChangePasswordController
{
    public function changePassword()
    {
        $oldPassword = md5($_POST['password']);
        $newPassword = md5($_POST['newPassword']);
        $rePassword = md5($_POST['rePassword']);
        $id = $_SESSION['id'];

        $result = Database::getConnection()->executeQuery("SELECT id, password FROM users WHERE id = '$id' " );
        $resultCheck = $result->fetchAssociative();
        if ($resultCheck['password'] == $oldPassword) {
            if ($newPassword === $rePassword) {
                if (!Database::getConnection()->executeQuery("SELECT password FROM users WHERE password = '$newPassword' ")->rowCount()) {
                    Database::getConnection()->Query("UPDATE users SET password = '$newPassword' WHERE id = '$id' ");

                }
            }
        }
        return new Navigation("/authorization");
    }
}