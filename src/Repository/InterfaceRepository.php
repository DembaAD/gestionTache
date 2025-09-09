<?php
namespace App\Repository;

use App\Model\Task;

interface InterfaceRepository{
    public function findById($id);
    public function create(Task $t);
    public function delete($id);
    public function update($id);
    public function all();
}