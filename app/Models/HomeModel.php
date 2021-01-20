<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HomeModel extends Model
{
    public function allData($id)
    {
        return DB::table('db_'.$id)->get();
    }

    public function detailData($id, $id_detail)
    {
        return DB::table('db_'.$id)->where('id_'.$id, $id_detail)->first();
    }

    public function insertData($id, $data)
    {
        return DB::table('db_'.$id)->insert($data);
    }

    public function updateData($id, $id_update, $data)
    {
        return DB::table('db_'.$id)->where('id_'.$id, $id_update)->update($data);
    }

    public function deleteData($id, $id_delete)
    {
        return DB::table('db_'.$id)->where('id_'.$id, $id_delete)->delete();
    }
}
