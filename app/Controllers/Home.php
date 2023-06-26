<?php namespace App\Controllers;

use App\Models\BarangModel;
use App\Controllers\BaseController;

class Home extends BaseController
{
	protected $BarangModel;

    public function __construct()
    {
        $this->BarangModel = new BarangModel();
		helper('number');
		helper('form');
    }

	public function index()
	{
		$data = [
			'title' => 'Daftar Barang',
			'isi' => 'v_home',
			'cart' => \Config\Services::cart(),
			'barang' => $this->BarangModel->getBarang()
		];
		echo view('layout/v_wrapper', $data);
	}

	//--------CRUD Shopping Cart----------------------------

	// Mengecek semua data barang yang ada di cart
	public function cek()
	{
		$cart = \Config\Services::cart();
		$response = $cart->contents();
		$data = json_encode($response);
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}

	// Menyimpan data barang ke cart
	public function addToCart()
	{
		$cart = \Config\Services::cart();
		$cart->insert(array(
			'id'      => $this->request->getPost('id'),
			'qty'     => 1,
			'price'   => $this->request->getPost('price'),
			'name'    => $this->request->getPost('name'),
			'options' => array(
				'gambar' => $this->request->getPost('gambar'),
				'berat' => $this->request->getPost('berat')
			)
		 ));
		session()->setFlashdata('success', 'Data barang berhasil ditambahkan ke dalam cart');
		return redirect()->to(base_url('home'));
	}

	// Menghapus semua data barang yang ada di cart
	public function clear()
	{
		$cart = \Config\Services::cart();
		$cart->destroy();
		session()->setFlashdata('success', 'Semua data keranjang berhasil dibersihkan');
		return redirect()->to(base_url('home/cart'));
	}

	// Menampilkan detail isi keranjang
	function cart()
	{
		$data = [
			'title' => 'Daftar Keranjang',
			'isi' => 'v_cart',
			'cart' => \Config\Services::cart()
		];
		echo view('layout/v_wrapper', $data);
	}

	public function updateCart()
	{
		// Meload data dari cart
		$cart = \Config\Services::cart();

		$i = 1;

		// Proses mengubah data
		foreach ($cart->contents() as $key => $value) {
			$cart->update(array(
				'rowid'   => $value['rowid'],
				'qty'     => $this->request->getPost('qty' . $i++),
		 	));
		}
		session()->setFlashdata('success', 'Data keranjang berhasil diubah');
		return redirect()->to(base_url('home/cart'));
	}

	public function delete($rowid)
	{
		// Meload data dari cart
		$cart = \Config\Services::cart();

		$cart->remove($rowid);
		session()->setFlashdata('success', 'Data barang berhasil dihapus');
		return redirect()->to(base_url('home/cart'));
	}
}
