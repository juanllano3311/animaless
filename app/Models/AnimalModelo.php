<?php namespace App\Models;

use CodeIgniter\Model;

class AnimalModelo extends Model {

    protected $table = 'animal';
    protected $primaryKey = 'id_animal';
    protected $allowedFields = ['id_animal', 'nombre', 'edad', 'tipo_animal', 'descr', 'comida'];
}