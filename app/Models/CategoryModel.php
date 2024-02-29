<?php 
namespace App\Models;
use CodeIgniter\Model;
class CategoryModel extends Model{

    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';    
    protected $allowedFields = ['detalle','activo'];
}
?>