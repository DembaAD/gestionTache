<?php
require 'dossier_inclus\db.php';
if(isset($_GET['id'])){
    if(!empty($_GET['id'])){
        
         header(
        'Location: index.php'
       );
       exit;
    }
}
