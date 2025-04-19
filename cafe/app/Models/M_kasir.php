<?php

namespace App\Models;
use CodeIgniter\Model;
use Exception;

class M_kasir extends Model
{
  protected $table = 'barang';
  protected $primaryKey = 'id_barang';
  protected $allowedFields = ['kode_barang', 'nama_barang', 'jenis_barang', 'harga_satuan', 'stok'];

  public function getWhere($table, $where){
     return $this->db->table($table)
     ->getWhere($where)
     ->getRow();
 }
	public function tampil($table, $by){  // Parameter / Props
		return $this->db->table($table)
		->orderby($by, 'desc')
		->get()
		->getResult();
	}
  public function tampil_level ($table, $where = [])
  {
    return $this->db->table($table)->where($where)->get()->getResult();
}

public function join($table, $table2, $on, $by){  
    return $this->db->table($table)
    ->orderby($by, 'desc')
    ->join($table2,$on)
    ->get()
    ->getResult();
}
public function join6($table, $table2, $table3, $on, $on2, $by){  
    return $this->db->table($table)
    ->orderby($by, 'desc')
    ->join($table2,$on)
    ->join($table3,$on2)
    ->get()
    ->getResult();
}
public function join7($table, $table2, $on){  
    return $this->db->table($table)
    ->join($table2,$on)
    ->get()
    ->getResult();
}
public function join8($table, $table2, $table3, $on, $on2){  
    return $this->db->table($table)
    ->join($table2,$on)
    ->join($table3,$on2)
    ->get()
    ->getResult();
}
public function joinNota()
{
    return $this->db->table('nota')
    ->select('nota.*, user.nama_user')
        ->join('user', 'nota.id_kasir = user.id_user', 'left') // <<<<<< PAKE LEFT JOIN
        ->orderBy('nota.id_nota', 'DESC')
        ->get()
        ->getResult();
    }
    public function joinNotaDetail2($id)
    {
        return $this->db->table('nota')
        ->select('nota.*, 
           user_kasir.nama_user AS nama_kasir, 
           user_customer.nama_user AS nama_customer, 
           pemesanan.nomor_meja')
        ->join('pemesanan', 'nota.nomor_nota = pemesanan.nomor_nota', 'left')
        ->join('user AS user_kasir', 'nota.id_kasir = user_kasir.id_user', 'left')
        ->join('user AS user_customer', 'pemesanan.id_user = user_customer.id_user', 'left')
        ->where('nota.id_nota', $id)
        ->get()
        ->getRow(); // Ensure this returns a single row of data with joined info
    }
    public function getItemsForNota($id_nota)
    {
        return $this->db->table('barang')
        ->select('barang.*, pemesanan.jumlah')
        ->join('pemesanan', 'pemesanan.kode_barang = barang.id_barang')  // Adjusted to match the join condition
        ->join('nota', 'pemesanan.nomor_nota = nota.nomor_nota')
        ->where('nota.id_nota', $id_nota)
        ->get()
        ->getResult();  // Get results as an array of objects
    }
  public function getLaporanKeuangan($awal, $akhir)
{
    $pemesanan = $this->db->table('pemesanan')
        ->select('
            pemesanan.kode_barang,
            barang.nama_barang,
            SUM(pemesanan.jumlah) as jumlah_terjual,
            SUM(pemesanan.jumlah * barang.harga_satuan) as total_pendapatan,
            SUM(pemesanan.jumlah * barang.harga_mentah) as total_modal
        ')
        ->join('barang', 'barang.id_barang = pemesanan.kode_barang')  // Updated to reflect correct join condition
        ->join('nota', 'nota.nomor_nota = pemesanan.nomor_nota')
        ->where('nota.tanggal >=', $awal)
        ->where('nota.tanggal <=', $akhir)
        ->where('pemesanan.status_pemesanan', 'selesai')
        ->groupBy('pemesanan.kode_barang, barang.nama_barang');

    $sqlPemesanan = '(' . $pemesanan->getCompiledSelect(false) . ')';

    $finalQuery = "
        SELECT 
        kode_barang, 
        nama_barang,
        SUM(jumlah_terjual) as jumlah_terjual,
        SUM(total_pendapatan) as total_pendapatan,
        SUM(total_modal) as modal,
        (SUM(total_pendapatan) - SUM(total_modal)) as laba
        FROM {$sqlPemesanan} AS laporan
        GROUP BY kode_barang, nama_barang
    ";

    $query = $this->db->query($finalQuery);

    return $query->getResultArray();
}

    public function getDetailPemesanan($id_pemesanan)
    {
        return $this->db->table('pemesanan')
        ->select('pemesanan.*, barang.nama_barang, user.nama_user, nota.nomor_nota, nota.metode_pembayaran, nota.keterangan')
        ->join('barang', 'pemesanan.kode_barang = barang.id_barang')
        ->join('user', 'pemesanan.id_user = user.id_user')
        ->join('nota', 'pemesanan.nomor_nota = nota.nomor_nota')
        ->where('pemesanan.id_pemesanan', $id_pemesanan)
        ->get()
        ->getRow();
    }
    public function cetak_all()
    {
        $orders = session()->get('filtered_orders');

        if (empty($orders)) {
            return redirect()->to('home/pemesanan')->with('error', 'Tidak ada data untuk dicetak.');
        }

    // Kamu buat tampilan khusus untuk print
        $data['orders'] = $orders;

        echo view('cetak_all', $data);
    }

    public function joinNotaDetail($id)
    {
        return $this->db->table('nota')
        ->select('nota.*, user_kasir.nama_user AS nama_kasir, user_customer.nama_user AS nama_customer, pemesanan.nomor_meja, pemesanan.status_pemesanan')
        ->join('pemesanan', 'nota.nomor_nota = pemesanan.nomor_nota', 'left')
        ->join('user AS user_kasir', 'nota.id_kasir = user_kasir.id_user', 'left')
        ->join('user AS user_customer', 'pemesanan.id_user = user_customer.id_user', 'left')
        ->where('nota.id_nota', $id)
        ->get()
        ->getRow(); // get a single row of data
    }

    public function join4($table, $table2, $table3, $table4, $on, $on2,$on3, $by){  
        return $this->db->table($table)
        ->orderby($by, 'desc')
        ->join($table2,$on)
        ->join($table3,$on2)
        ->join($table4,$on3)
        ->get()
        ->getResult();
    }
    public function join3($table, $table2, $table3, $table4, $on, $on2, $on3, $by)
    {  
        return $this->db->table($table)
        ->orderBy(key($by), 'desc')
        ->where($by)
        ->join($table2, $on)
        ->join($table3, $on2)
        ->join($table4, $on3)
        ->get()
        ->getRow(); // <-- ambil satu baris saja karena nota 1 ID
    }

    public function getBarangByKode($kode_barang)
    {
    // Fetch item details based on kode_barang from the barang table
        return $this->db->table('barang')
        ->where('kode_barang', $kode_barang)
        ->get()
        ->getRowArray();
    }
    public function join5($table1, $table2, $table3, $table4, $on1, $on2, $on3, $where)
    {
        return $this->db->query("
            SELECT *, pemesanan.tanggal as tanggal_pemesanan
            FROM $table1
            JOIN $table2 ON $on1
            JOIN $table3 ON $on2
            JOIN $table4 ON $on3
            $where
            GROUP BY pemesanan.nomor_nota
            ORDER BY pemesanan.kode_pemesanan DESC
            ")->getResultArray();
    }


    public function getItemsByOrder($nomor_nota)
    {
        return $this->db->table('pemesanan')
        ->select('barang.nama_barang, pemesanan.jumlah')
        ->join('barang', 'pemesanan.kode_barang = barang.id_barang')
        ->where('pemesanan.nomor_nota', $nomor_nota)
        ->get()
        ->getResultArray();
    }


    public function joinw($table, $table2, $on, $w){  
        return $this->db->table($table)
        ->join($table2,$on)
        ->where($w)
        ->get()
        ->getRow();
    }
    public function join1($table, $table2, $table3, $table4, $on, $on1, $on2, $by, $nomorNota)
    {
        return $this->db->table($table)
        ->select('*')
        ->join($table2, $on)
        ->join($table3, $on1)
        ->join($table4, $on2)
        ->where('transaksi.nomor_nota', $nomorNota)
        ->where('CAST(transaksi.tanggal AS DATE) =', date('Y-m-d')) // Explicit date cast
        ->where('CAST(nota.tanggal AS DATE) =', date('Y-m-d')) // Explicit date cast
        ->groupBy('transaksi.kode_barang')
        ->orderBy($by, 'desc')
        ->get()
        ->getResult();
    }

//   public function join1($table, $table2, $table3, $table4, $on, $on1, $on2, $by, $nomorNota)
// {
//     return $this->db->table($table)
//         ->select('*')
//         ->join($table2, $on)
//         ->join($table3, $on1)
//         ->join($table4, $on2)
//         ->where('transaksi.nomor_nota', $nomorNota)
//         ->where('DATE(transaksi.tanggal)', date('Y-m-d')) // Ensure transaksi is from today
//         ->where('DATE(nota.tanggal)', date('Y-m-d')) // Ensure nota is also from today
//         ->groupBy('transaksi.kode_barang')
//         ->orderBy($by, 'desc')
//         ->get()
//         ->getResult();
// }
    public function join2($table, $table2, $table3, $table4, $on, $on1, $on2, $where = [])
    {
        $query = $this->db->table($table)
        ->select('transaksi.*, nota.nomor_nota, nota.tanggal, kasir.nama_kasir, barang.nama_barang, barang.harga_satuan as harga, transaksi.jumlah, transaksi.sub_total, nota.grand_total, nota.bayar, nota.kembali')
        ->join($table2, $on)
        ->join($table3, $on1)
        ->join($table4, $on2)
        ->where($where)
        ->where('transaksi.tanggal = nota.tanggal') // Ensure the transaction date matches nota date
        ->groupBy('transaksi.id_transaksi')
        ->orderBy('transaksi.id_transaksi', 'DESC');

        return $query->get()->getResult();
    }

//  public function join2($table, $table2, $table3, $table4, $on, $on1, $on2,  $where = [])
// {
//     return $this->db->table($table)
//         ->join($table2, $on)
//         ->join($table3, $on1)
//         ->join($table4, $on2)
//         ->where($where)
//         ->groupBy('transaksi.kode_barang')
//         ->get()
//         ->getResult();
// }

    public function filter($table, $table2, $on, $filter, $filter2, $awal, $akhir, $by){  
     return $this->db->table($table)
     ->join($table2,$on)
     ->where($filter,$awal)
     ->where($filter2,$akhir)
     ->orderby($by, 'desc')
     ->get()
     ->getResult();
 }
 public function transaksi_filter($awal, $akhir, $by) {  
    $query = $this->db->table('transaksi')
    ->join('nota', 'transaksi.nomor_nota = nota.nomor_nota AND transaksi.tanggal = nota.tanggal')
    ->join('kasir', 'transaksi.id_kasir = kasir.id_kasir')
    ->join('barang', 'transaksi.kode_barang = barang.kode_barang')
    ->where("DATE_FORMAT(transaksi.tanggal, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'")
    ->orderBy($by, 'desc')
    ->get();

    if (!$query) {
        die("Query Error: " . $this->db->error()['message']);
    }

    return $query->getResult();
}

public function input($table, $data){
 return $this->db->table($table)
 ->insert($data);
}
public function hapus($table, $where){
 return $this->db->table($table)
 ->delete($where);
}
public function edit($table, $data, $where){
 return $this->db->table($table)
 ->update($data, $where);
}
 //SOFT DELETE//
  // Soft delete method with deleted_at (WORKS)
 // Soft delete (mark deleted_at timestamp)
    // public function soft_delete($id) {
    //     $this->db->table($this->table)
    //              ->where('id_barang', $id)
    //              ->update(['deleted_at' => date('Y-m-d H:i:s')]); 
    // }

//FOR ANY TABLE//
 // Soft delete (set status to 0)
public function soft_delete($table, $id_column, $id)
{
    $data = [
            'deleted_at' => date('Y-m-d H:i:s', time()), // Asia/Jakarta time
            'deleted_by' => session()->get('nama_user'),
            'status' => 0 // Mark user as inactive (soft delete)
        ];
        return $this->db->table($table)->update($data, [$id_column => $id]);
    }
    // Restore soft-deleted records (set status back to NULL)
    public function restore($table, $column, $id) {
        return $this->db->table($table)
        ->where($column, $id)
        ->update([
            'status' => NULL,
            'deleted_by' => NULL,
            'deleted_at' => NULL
        ]);
    }
    public function restore_all($table) {
        return $this->db->table($table)
                    ->where('status', 0) // Only where status = 0
                    ->update([
                        'status' => NULL,
                        'deleted_by' => NULL,
                        'deleted_at' => NULL
                    ]);
                }


    // Fetch active (not deleted) records with sorting
                public function tampil_active($table, $column, $where = [], $sort = 'id', $order = 'DESC') {
                    $builder = $this->db->table($table);
        $builder->where('status IS NULL', null, false); // Active records
        $builder->orderBy($sort, $order);

        if (!empty($where)) {
            $builder->where($where);
        }

        return $builder->get()->getResult();
    }

    public function tampil_active_no_sort($table, $column, $where = []) {
        $builder = $this->db->table($table);
        $builder->where('status IS NULL', null, false); // Active records
    $builder->orderBy($column, 'DESC'); // Default ordering by column in descending order

    if (!empty($where)) {
        $builder->where($where);
    }

    return $builder->get()->getResult();
}

    // Fetch soft-deleted records with sorting
public function get_deleted_items($table, $column, $sort = 'id', $order = 'DESC') {
    return $this->db->table($table)
                        ->where('status', 0) // Soft deleted records
                        ->orderBy($sort, $order)
                        ->get()
                        ->getResult();
                    }
                    public function get_deleted_items_no_sort($table, $column, $order = 'DESC') {
                        return $this->db->table($table)
                    ->where('status', 0) // Soft deleted records
                    ->orderBy($column, $order) // FIXED: Now orders by correct column
                    ->get()
                    ->getResult();
                }
    // Permanently delete (set status to 1)
                public function hard_delete($table, $column, $id) {
                    return $this->db->table($table)
                    ->where($column, $id)
                    ->delete();
                }

  // Join kasir with user (No sorting, only order by DESC)
                public function join_barang_kategori($where = []) {
                    $builder = $this->db->table('barang');
                    $builder->join('kategori', 'barang.kategori = kategori.id_kategori');
        $builder->where('barang.status IS NULL', null, false); // Active kasir only
        $builder->orderBy('barang.id_barang', 'DESC'); // Only ordering by DESC

        if (!empty($where)) {
            $builder->where($where);
        }

        return $builder->get()->getResult();
    }

     // Join kasir with user (No sorting, only order by DESC)
    public function join_kasir_user($where = []) {
        $builder = $this->db->table('kasir');
        $builder->join('user', 'kasir.id_user = user.id_user');
        $builder->where('kasir.status IS NULL', null, false); // Active kasir only
        $builder->orderBy('kasir.id_kasir', 'DESC'); // Only ordering by DESC

        if (!empty($where)) {
            $builder->where($where);
        }

        return $builder->get()->getResult();
    }


    // Soft delete kasir and user (set status to 0)
    public function soft_delete_kasir($id) {
        $nama_user = session()->get('nama_user');
        $deleted_at = date('Y-m-d H:i:s');

        return $this->db->table('kasir')
        ->where('id_user', $id)
        ->update([
            'status' => 0,
            'deleted_by' => $nama_user,
            'deleted_at' => $deleted_at
        ]) &&
        $this->db->table('user')
        ->where('id_user', $id)
        ->update([
            'status' => 0,
            'deleted_by' => $nama_user,
            'deleted_at' => $deleted_at
        ]);
    }

    // Restore soft-deleted kasir and user
    public function restore_kasir($id) {
        return $this->db->table('kasir')
        ->where('id_user', $id)
        ->update([
            'status' => NULL,
            'deleted_by' => NULL,
            'deleted_at' => NULL
        ]) &&
        $this->db->table('user')
        ->where('id_user', $id)
        ->update([
            'status' => NULL,
            'deleted_by' => NULL,
            'deleted_at' => NULL
        ]);
    }
   // Restore soft-deleted kasir and user
    public function restore_all_kasir() {
        return $this->db->table('kasir')
                    ->where('status', 0) // Only where status = 0
                    ->update([
                        'status' => NULL,
                        'deleted_by' => NULL,
                        'deleted_at' => NULL
                    ]) &&
                    $this->db->table('user')
                     ->where('status', 0) // Only where status = 0
                     ->update([
                        'status' => NULL,
                        'deleted_by' => NULL,
                        'deleted_at' => NULL
                    ]);
                 }
     // Restore soft-deleted kasir and user
                 public function hard_delete_kasir($id) {
                    return $this->db->table('kasir')
                    ->where('id_user', $id)
                    ->delete() &&
                    $this->db->table('user')
                    ->where('id_user', $id)
                    ->delete();
                }

    // Get soft deleted kasir (No sorting, only order by DESC)
                public function get_deleted_kasir() {
                    return $this->db->table('kasir')
                    ->join('user', 'kasir.id_user = user.id_user')
                        ->where('kasir.status', 0) // Only soft deleted records
                        ->orderBy('kasir.id_kasir', 'DESC')
                        ->get()
                        ->getResult();
                    }
                    public function countTodayPemesanan($today)
                    {
                        return $this->db->table('pemesanan')
                        ->where('DATE(tanggal)', $today)
                        ->countAllResults();
                    }

                    public function countTodayNota($today)
                    {
                        return $this->db->table('nota')
                        ->where('DATE(tanggal)', $today)
                        ->countAllResults();
                    }
// Di dalam Model M_kasir.php
                    public function updateNota_manual($id_nota, $data)
                    {
    // Cek apakah id_nota ada
                        if ($this->db->table('nota')->where('id_nota', $id_nota)->countAllResults() > 0) {
        // Melakukan update ke tabel nota
                            return $this->db->table('nota')->where('id_nota', $id_nota)->update($data);
                        }
    return false; // Jika id_nota tidak ada
}
public function updateNota($id_nota, $data)
{
    return $this->db->table('nota')
        ->where('id_nota', $id_nota)  // Use id_nota instead of nomor_nota
        ->update($data);
    }
    public function updateStatusPemesanan($nomor_nota, $status_pemesanan)
    {
        return $this->db->table('pemesanan')
        ->where('nomor_nota', $nomor_nota)
        ->update(['status_pemesanan' => $status_pemesanan]);
    }
// Function ambil item pesanan berdasarkan nomor_nota
    private function getPemesananByNota($nomor_nota)
    {
        return $this->db->table('pemesanan')
        ->join('barang', 'barang.kode_barang = pemesanan.kode_barang')
        ->select('barang.nama_barang, pemesanan.jumlah')
        ->where('pemesanan.nomor_nota', $nomor_nota)
        ->get()
        ->getResultArray();
    }

    public function getNotaByNomor($nomor_nota)
    {
        return $this->db->table('nota')
        ->where('nomor_nota', $nomor_nota)
        ->get()
        ->getRowArray();
    }
    public function getNotaByNomor2($nomor_nota)
    {
        return $this->db->table('nota')
        ->select('
            nota.nomor_nota,
            nota.tanggal,
            user_customer.nama_user AS nama_customer,
            pemesanan.nomor_meja
            ')
        ->join('pemesanan', 'pemesanan.nomor_nota = nota.nomor_nota', 'left')
        ->join('user AS user_customer', 'pemesanan.id_user = user_customer.id_user', 'left')
        ->where('nota.nomor_nota', $nomor_nota)
        ->get()
        ->getRowArray(); // hasilnya array supaya cocok sama view kamu
    }


    public function getNotaById($id_nota)
    {
        return $this->db->table('nota')->where('id_nota', $id_nota)->get()->getRowArray();
    }

   public function getUserLogs($nama_user)
{
    return $this->db->table('log_activity')
                    ->where('nama_user', $nama_user)
                    ->orderBy('waktu', 'DESC')
                    ->get()
                    ->getResult();
}

    public function getAllLogs()
    {
        return $this->db->table('log_activity')
            ->orderBy('waktu', 'DESC')
            ->get()
            ->getResult(); // Return array of objects
    }

public function insertLog($activity)
{
    date_default_timezone_set('Asia/Jakarta'); // Set timezone to Jakarta

    $nama_user = session()->get('nama_user') ?? 'Guest';
    $username = session()->get('username') ?? 'guest';

    $ip_address = file_get_contents("https://api.ipify.org"); // Get public IP

    $data = [
        'waktu'      => date('Y-m-d H:i:s'),
        'date'       => date('Y-m-d'),
        'nama_user'  => $nama_user, // ✅ Use nama_user from session
        'username'   => $username,
        'activity'   => $activity,
        'ip_address' => $ip_address
    ];

    $this->db->table('log_activity')->insert($data);
}
}