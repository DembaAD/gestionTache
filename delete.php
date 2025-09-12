<?php
require 'vendor/autoload.php';

use App\Repository\TaskRepository;

if(isset($_GET['id'])){
    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $repository = new TaskRepository();
        $repository->delete($id);
         header(
        'Location: index.php'
       );
       exit;
    }
}
