<?php namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'tbl_barang';

    public function getBarang()
    {
        // return $this->db->table('tbl_barang')
        // ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_barang.id_kategori')
        // ->get()->getResultArray();

        return $this->findAll();
    }
}