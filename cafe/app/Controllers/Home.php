<?php

namespace App\Controllers;
use App\Models\M_kasir;
use CodeIgniter\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
    public function __construct()
    {
        $this->MKasir = new M_kasir(); // Initialize the model
    }
    public function registrasi()
    {
        echo view('header');
        echo view('registrasi');
    }
    public function aksi_registrasi()
    {
        $a=$this->request->getPost('name');
        $b=$this->request->getPost('username');
        $c=$this->request->getPost('password');

        $MKasir= new M_kasir;
        // $createdBy = session()->get('nama_user') ?? 'Self';

        $data = array(
            "nama_user"=>$a,
            "username"=>$b,
            "password"=>MD5($c),
            "level"=> 4,
            "created_at" => date('Y-m-d H:i:s', time()),
            // "created_by" => $createdBy
        );
        $MKasir->input('user',$data);

        $cek = $MKasir->getWhere('user', $data);

        if ($cek != null) {

            session()->set('id', $cek->id_user);
            session()->set('u', $cek->username);
            session()->set('level', $cek->level);
            session()->set('nama_user', $cek->nama_user);

            //penulisan kode array isinya pakai $cek[isinya]//
            return redirect ()->to('home/dashboard');
        }else{
            return redirect ()->to('home/login');
        }
    }
    public function login()
    {
// Di controller login view (misal Home::login)
        $angka1 = rand(1, 10);
        $angka2 = rand(1, 10);
        $soal_captcha = "$angka1 + $angka2";
        session()->set('captcha_jawaban', $angka1 + $angka2);

// Kirim ke view
        return view('login', ['soal_captcha' => $soal_captcha, 'pengaturan' => $pengaturan]);

        echo view('header');
        echo view('login');
    }
    public function aksi_login()
    {
        $isOnline = $this->request->getPost('is_online');

        if ($isOnline == '1') {
    // Google reCAPTCHA
            $recaptcha_response = $this->request->getPost('g-recaptcha-response');
            $recaptcha_secret = '6LeCA-8qAAAAABuno2XGm47dVSu9ifnffdncFeJR';
            $verify_url = "https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}";
            $response = file_get_contents($verify_url);
            $result = json_decode($response, true);
            if (!$result['success']) {
                return redirect()->to('home/login')->with('error', 'reCAPTCHA tidak valid!');
            }
        } else {
    // Math Captcha
            $jawaban = (int)$this->request->getPost('captcha_jawaban');
    $jawabanBenar = session()->get('captcha_jawaban'); // simpan ini saat generate view
    if ($jawaban !== $jawabanBenar) {
        return redirect()->to('home/login')->with('error', 'Jawaban captcha salah!');
    }
}

$username=$this->request->getPost('username');
$password=$this->request->getPost('password');

$MKasir= new M_kasir;
$data = array(
    "username"=>$username,
    "password"=>md5($password)
);
      // Check if the credentials exist

$cek = $MKasir->getWhere('user', $data);

        // print_r($cek);
        // $cek uhh//
        // ini karena kitaa nyetak, harus menggunahkan echo, kalau error, karena di model tak ada Array akhirnya//
if ($cek != null) {

            // ✅ General session data for all users
    $sessionData = [
        'id_user'   => $cek->id_user,
        'username'  => $cek->username,
        'nama_user' => $cek->nama_user,
        'level'     => $cek->level,
        'logged_in' => true
    ];

        // ✅ If user is kasir (level 2), store kasir details too
    if ($cek->level == 2) {
        $kasir = $MKasir->getWhere('kasir', ['id_user' => $cek->id_user]);
        if ($kasir) {
            $sessionData['id_kasir']   = $kasir->id_kasir;
            $sessionData['nama_kasir'] = $kasir->nama_kasir;
        }
    }

        // ✅ Set session (general + kasir if applicable)
    session()->set($sessionData);

              // ✅ Fetch nama_user from the user table
                $this->MKasir->insertLog("$cek->nama_user successfully logged in");
    return redirect ()->to('home/dashboard');
}else{

                $this->MKasir->insertLog("Failed login attempt");

    session()->setFlashdata('error', 'invalid incredentials, Please try again.');
    return redirect ()->to('home/login');
}
}
public function logout()
{
    $nama_user = session()->get('nama_user');
            if ($nama_user) {
            $this->MKasir->insertLog("$nama_user logged out"); // ✅ Logs real nama_user
        }
    session()->destroy();
    return redirect ()->to('home/login');
}
public function forgot_password()
{
    echo view ('header');
    echo view ('forgot_password');
}

public function aksi_forgot_password()
{
    $MKasir = new M_kasir();
    $email = $this->request->getPost('email');

    // Check if the email exists in the database
    $user = $MKasir->getWhere('user', ['username' => $email]);

    if (!$user || !is_object($user)) {
        echo "No user found with this email.";
        return;
    }
    date_default_timezone_set('Asia/Jakarta');

    // Generate token and expiry
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", strtotime("+20 minutes"));

    // Save token to the database
    $MKasir->edit('user', [
        'token' => $token_hash,
        'expiry' => $expiry
    ], ['username' => $email]);

    // Reset link
    $resetLink = base_url("/home/aksi_reset_password?token=$token");

    // Create email content
    $subject = "Password Reset Request";
    $message = "
    <html>
    <head>
    <title>Password Reset Request</title>
    </head>
    <body>
    <p>Hey bucko.. i got you your mail here</p>
    <p>It seems like you've requested to reset your 'password', heres the link bellow</p>
    <p><a href='$resetLink' style='color: blue;'>Reset Password</a></p>
    <p>if this isnt from you requesting.. just ignore it, and ill take care of it, dont worry buddy</p>
    <p>from</p>
    <p>the punny skeleton, your safety security</p>
    </body>
    </html>
    ";

    // Send the email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
       $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';   // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'chelsicachelsica@gmail.com';  // Your email
        $mail->Password   = 'enzh pbqa lnaf byhm';    // App password (NOT your real email password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587; 

        // Recipients
        $mail->setFrom('chelsicachelsica@gmail.com', 'Cafe');
        $mail->addAddress($email);  


        // Content
        $mail->isHTML(true);                                
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        $data['message'] = "A password reset link has been sent to your email.";
        $data['type'] = "success";
        return view('message_view', $data);
    } catch (Exception $e) {
        $data['message'] = "Failed to send email. Error: {$mail->ErrorInfo}";
        $data['type'] = "error";
        return view('message_view', $data);
    }
}

public function aksi_reset_password()
{
    $MKasir = new M_kasir();
    $token = $_GET['token'] ?? '';
    $token_hash = hash('sha256', $token); // Hash the token from the URL

    date_default_timezone_set('Asia/Jakarta');
    // Validate the token
    $reset = $MKasir->getWhere('user', ['token' => $token_hash]);

    if (!$reset || !is_object($reset) || strtotime($reset->expiry) < time()) {
        $data['message'] = "Invalid or expired token.";
        return view('error_view', $data); // Render an error view
    }

    // Pass token to the view for the form
    $data['token'] = $token;
    return view('reset_password', $data); // Render the reset password view
}



public function update_password()
{
    $MKasir = new M_kasir();
    $token = $_GET['token'] ?? '';
    $token_hash = hash('sha256', $token); // Ensure token is hashed consistently
    $password = $this->request->getPost('password');
    $confirmPassword = $this->request->getPost('confirm_password');

    if ($password !== $confirmPassword) {
        $data['message'] = "Passwords do not match.";
        $data['type'] = "error";
        return view('status_view', $data); // Render error view
    }

    // Set the correct timezone for comparison
    date_default_timezone_set('Asia/Jakarta');

    // Validate the token
    $reset = $MKasir->getWhere('user', ['token' => $token_hash]);

    if (!$reset || !is_object($reset) || strtotime($reset->expiry) < time()) {
        $data['message'] = "Invalid or expired token.";
        $data['type'] = "error";
        return view('status_view', $data); // Render error view
    }

    // Hash the new password
    $hashedPassword = md5($password);

    // Update the user's password
    $MKasir->edit('user', ['password' => $hashedPassword], ['username' => $reset->username]);

    // Delete the reset token
    $MKasir->edit('user', ['token' => null, 'expiry' => null], ['username' => $reset->username]);

    $data['message'] = "Your password has been updated successfully.";
    $data['type'] = "success";
    return view('status_view', $data); // Render success view
}
public function log_activity()
{
    if (session()->get('level')==1 ||  session()->get('level')==2 || session()->get('level')==3 ||  session()->get('level')==4) {
     $level = session()->get('level');
     $nama_user = session()->get('nama_user');

     if ($level == 1 || $level == 3) {
        // ✅ Admin → show all logs
        $data['logs'] = $this->MKasir->getAllLogs();
    } elseif ($level == 2 || $level == 4 ) {
        // ✅ Regular user → show only their logs
        $data['logs'] = $this->MKasir->getUserLogs($nama_user);
    } else {
        // ✅ If user is not logged in or unauthorized → redirect
        if ($level > 0) {
            return redirect()->to('home/error');
        } else {
            return redirect()->to('home/login');
        }
    }


    if ($nama_user) {
        $this->MKasir->insertLog("$nama_user visited log activity");
    }
    echo view('header');
    echo view('menu');
    echo view('log_activity', $data);
    echo view('footer');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function dashboard()
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3 || session()->get('level')==4) {
     $nama_user = session()->get('nama_user');
       if ($nama_user) {
        $this->MKasir->insertLog("$nama_user Visited dashboard"); // ✅ Logs real nama_user
    }

     echo view('header');
     echo view('menu');
     echo view('dashboard');
     echo view('footer');
 }else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function tabel_kasir()
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    $MKasir= new M_kasir;

    $where= ('id_kasir');
                    // Get active kasir
    $parent['child'] = $MKasir->join_kasir_user();

    echo view('header');
    echo view ('menu.php');
    echo view ('tabel_kasir',$parent);
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function tabel_kasir_deleted() {
   if (session()->get('level')==3) {
    $MKasir = new M_kasir;
        // Get deleted kasir
    
    $parent['deleted_items'] = $MKasir->get_deleted_kasir();

    echo view('header');
    echo view('menu.php');
    echo view('tabel_kasir_deleted', $parent);
    echo view('footer.php');
} else if (session()->get('level') > 0) {
    return redirect()->to('home/error');
} else {
    return redirect()->to('home/login');
}
}
public function tambah_kasir()
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    echo view('header');
    echo view ('menu.php');
    echo view ('tambah_kasir');
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}

public function simpan_tambah_kasir()
{
    $a=$this->request->getPost('username');
    $b=$this->request->getPost('password');
    $c=$this->request->getPost('nama');
    $d=$this->request->getPost('nik');


    $MKasir= new M_kasir;

    $data = array(
        "username"=>$a,
        "password"=>md5($b),
        "nama_user"=>$c,
        "level"=> 2,
        "created_at" => date('Y-m-d H:i:s', time()),
        "created_by" => session()->get('nama_user')
    );
    $MKasir->input('user', $data);

    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user successfully added '{$data['username']}' to user"); // ✅ Logs real nama_user
        }

        $where = array(
            "username"=>$a
        );
        $parent=$MKasir->getWhere('user', $where);
        // echo $wendy->id_user;
        $data2=array(
            "id_user"=>$parent->id_user,
            "nama_kasir"=>$c,
            "nik"=>$d,
            "created_at" => date('Y-m-d H:i:s', time()),
            "created_by" => session()->get('nama_user')
        );
        // print_r($data2);
        $MKasir->input('kasir', $data2);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user successfully added '{$data2['nama_kasir']}' to kasir"); // ✅ Logs real nama_user
        }


        $where = array(
            "nik"=>$d
        );
        $parent=$MKasir->getWhere('kasir', $where);
        return redirect ()->to('home/tabel_kasir');
    }
    // public function hapus_kasir ($id)
    // {
    //     $MKasir= new M_kasir;
    //     $fetch_id= array('id_user' =>$id);
    //     $MKasir->hapus('kasir',$fetch_id);
    //     $MKasir->hapus('user',$fetch_id);
    //     return redirect()->to('home/tabel_kasir');
    // }


    public function hapus_kasir($id) {
        $MKasir = new M_kasir;
        $MKasir->soft_delete_kasir($id);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user deleted kasir with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_kasir');
    }

    public function restore_kasir($id) {
        $MKasir = new M_kasir;
        $MKasir->restore_kasir($id);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored kasir with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_kasir_deleted');
    }
    public function delete_permanently_kasir($id) {
        $MKasir = new M_kasir;
        $MKasir->hard_delete_kasir($id);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user permanently deleted kasir with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_kasir_deleted');
    }
    public function restore_all_kasir() {
        $MKasir = new M_kasir;
    $MKasir->restore_all_kasir(); // Restore all soft-deleted records
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored all kasir"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_kasir_deleted')->with('message', 'All kasir have been restored!');
    }
    public function detail_kasir ($id)
    {
     if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;
        $fetch_id= array('kasir.id_user' =>$id);
        $parent['child']=$MKasir->joinw('kasir', 'user', 'kasir.id_user=user.id_user', $fetch_id);
        echo view('header');
        echo view ('menu.php');
        echo view ('detail_kasir',$parent);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function edit_kasir ($id)
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    $MKasir= new M_kasir;
    $fetch_id= array('kasir.id_user' =>$id);
    $parent['child']=$MKasir->joinw('kasir', 'user', 'kasir.id_user=user.id_user', $fetch_id);
    echo view('header');
    echo view ('menu.php');
    echo view ('edit_kasir',$parent);
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}

public function simpan_edit_kasir()
{
    $a=$this->request->getPost('username');
    $b=$this->request->getPost('password');
    $c=$this->request->getPost('nama');
    $d=$this->request->getPost('nik');

    $id = $this->request->getPost('id');
    $MKasir = new M_kasir;
    $where = array("id_user" => $id);

    // Update 'user' table data
    $data = array(
        "username"=>$a,
        "password"=>md5($b),
        "nama_user"=>$c,
        "level" => 2,
        "updated_at" => date('Y-m-d H:i:s', time()),
        "updated_by" => session()->get('nama_user')
    );
    $MKasir->edit('user', $data, $where);
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user edit '{$data['username']}' to user"); // ✅ Logs real nama_user
        }
    // Update 'dokter' table data
        $data2 = array(
            "nama_kasir"=>$c,
            "nik"=>$d,
            "updated_at" => date('Y-m-d H:i:s', time()),
            "updated_by" => session()->get('nama_user')
            // "status"=>"2"
        );
        $MKasir->edit('kasir', $data2, $where);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user edit '{$data2['nama_kasir']}' to kasir"); // ✅ Logs real nama_user
        }

        return redirect()->to('home/tabel_kasir');
    }
    public function tabel_user()
    {
     if (session()->get('level')==1 || session()->get('level')==3) {
        $MKasir= new M_kasir;

        // FIXED: Use the correct function names
        $parent['child'] = $MKasir->tampil_active_no_sort('user', 'id_user', []);

        echo view('header');
        echo view ('menu.php');
        echo view ('tabel_user',$parent);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function tabel_user_deleted()
{
    if (session()->get('level')==3) {
        $MKasir= new M_kasir;

        $parent['deleted_items'] = $MKasir->get_deleted_items_no_sort('user', 'id_user');

        echo view('header');
        echo view ('menu.php');
        echo view ('tabel_user_deleted',$parent);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function tambah_user()
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    echo view('header');
    echo view ('menu.php');
    echo view ('tambah_user.php');
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function simpan_tambah_user()
{
    $MKasir= new M_kasir;
    $data = array(
        'username'=> $this->request->getPost('username'),
        'password'=> md5 ($this->request->getPost('password')),
        'nama_user'=> $this->request->getPost('nama'),
        'level'=> $this->request->getPost('level'),
             'created_at'  => date('Y-m-d H:i:s', time()), // ✅ Use Jakarta timezone
             'created_by'  => session()->get('nama_user')
         );

    $MKasir= new M_kasir;
    $MKasir->input('user',$data);
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user successfully added '{$data['username']}' to user"); // ✅ Logs real nama_user
        }
        return redirect ()->to('home/tabel_user');
    }
    // public function hapus_user($id)
    // {
    //     $MKasir= new M_kasir;
    //     $fetch_id= array('id_user' =>$id);
    //     $parent['child']=$MKasir->hapus('user',$fetch_id);
    //     return redirect()->to('home/tabel_user');
    // }
    public function hapus_user($id) {
        $MKasir = new M_kasir;
        $MKasir->soft_delete('user', 'id_user', $id); // Soft delete by setting status = 0
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user deleted user with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_user');
    }

    public function restore_user($id) {
        $MKasir = new M_kasir;
        $MKasir->restore('user', 'id_user', $id); // Restore by setting status = NULL
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored user with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_user_deleted');
    }

    public function delete_permanently_user($id) {
        $MKasir = new M_kasir;
        $MKasir->hard_delete('user', 'id_user', $id); // Mark as permanently deleted (status = 1)
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user permanently delete user with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_user_deleted');
    }
    public function restore_all_user() {
        $MKasir = new M_kasir;
    $MKasir->restore_all('user'); // Restore all soft-deleted records
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored all user"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_user_deleted')->with('message', 'All user have been restored!');
    }
    public function detail_user($id)
    {
     if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;
        $fetch_id= array('id_user' =>$id);
        $parent['child']=$MKasir->getWhere('user',$fetch_id);
        echo view('header');
        echo view ('menu.php');
        echo view ('detail_user',$parent);
        echo view ('footer.php');
        //echo view "barang", itu dari view, bukan database gudang//
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function edit_user($id)
{
 if (session()->get('level')==1 || session()->get('level')==3) {
    $MKasir= new M_kasir;
    $fetch_id= array('id_user' =>$id);
    $parent['child']=$MKasir->getWhere('user',$fetch_id);
    echo view('header');
    echo view ('menu.php');
    echo view ('edit_user',$parent);
    echo view ('footer.php');
        //echo view "barang", itu dari view, bukan database gudang//
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function simpan_edit_user()
{
    $a=$this->request->getPost('username');
    $b=md5($this->request->getPost('password'));
    $c=$this->request->getPost('nama');
    $d=$this->request->getPost('level');
        $e=date('Y-m-d H:i:s', time()); // ✅ Use Jakarta timezone
        $f=session()->get('nama_user');
        $id=$this->request->getPost('id');
        $MKasir= new M_kasir;
        $fetch_id= array('id_user' =>$id);
        $data = array(
            "username"=>$a,
            "password"=>$b,
            "nama_user"=>$c,
            "level"=>$d,
            "updated_at"=>$e,
            "updated_by"=>$f
        );

        $MKasir= new M_kasir;
        $MKasir->edit('user',$data, $fetch_id);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user edit '{$data['username']}' to user"); // ✅ Logs real nama_user
        }
        return redirect ()->to('home/tabel_user');
    }
    
    public function tabel_kategori()
    {
     if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;

        // FIXED: Use the correct function names
        $parent['child'] = $MKasir->tampil_active_no_sort('kategori', 'id_kategori', []);

        echo view('header');
        echo view ('menu.php');
        echo view ('tabel_kategori',$parent);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function tabel_kategori_deleted()
{
    if (session()->get('level')==3) {
        $MKasir= new M_kasir;

        $parent['deleted_items'] = $MKasir->get_deleted_items_no_sort('kategori', 'id_kategori');

        echo view('header');
        echo view ('menu.php');
        echo view ('tabel_kategori_deleted',$parent);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function tambah_kategori()
{
   if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
    echo view('header');
    echo view ('menu.php');
    echo view ('tambah_kategori.php');
    echo view ('footer.php');
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function simpan_tambah_kategori()
{
    $MKasir= new M_kasir;
    $data = array(
        'nama_kategori'=> $this->request->getPost('nama_kategori'),
             'created_at'  => date('Y-m-d H:i:s', time()), // ✅ Use Jakarta timezone
             'created_by'  => session()->get('nama_user')
         );

    $MKasir= new M_kasir;
    $MKasir->input('kategori',$data);
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user successfully added to kategori"); // ✅ Logs real nama_user
        }
        return redirect ()->to('home/tabel_kategori');
    }
    // public function hapus_user($id)
    // {
    //     $MKasir= new M_kasir;
    //     $fetch_id= array('id_user' =>$id);
    //     $parent['child']=$MKasir->hapus('user',$fetch_id);
    //     return redirect()->to('home/tabel_user');
    // }
    public function hapus_kategori($id) {
        $MKasir = new M_kasir;
        $MKasir->soft_delete('kategori', 'id_kategori', $id); // Soft delete by setting status = 0
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user deleted kategori with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_kategori');
    }

    public function restore_kategori($id) {
        $MKasir = new M_kasir;
        $MKasir->restore('kategori', 'id_kategori', $id); // Restore by setting status = NULL
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored kategori with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_kategori_deleted');
    }

    public function delete_permanently_kategori($id) {
        $MKasir = new M_kasir;
        $MKasir->hard_delete('kategori', 'id_kategori', $id); // Mark as permanently deleted (status = 1)
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user permanently delete kategori with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_kategori_deleted');
    }
    public function restore_all_kategori() {
        $MKasir = new M_kasir;
    $MKasir->restore_all('kategori'); // Restore all soft-deleted records
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored all kategori"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_kategori_deleted')->with('message', 'All kategori have been restored!');
    }
    public function detail_kategori($id)
    {
     if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;
        $fetch_id= array('id_kategori' =>$id);
        $parent['child']=$MKasir->getWhere('kategori',$fetch_id);
        echo view('header');
        echo view ('menu.php');
        echo view ('detail_kategori',$parent);
        echo view ('footer.php');
        //echo view "barang", itu dari view, bukan database gudang//
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function edit_kategori($id)
{
  if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
    $MKasir= new M_kasir;
    $fetch_id= array('id_kategori' =>$id);
    $parent['child']=$MKasir->getWhere('kategori',$fetch_id);
    echo view('header');
    echo view ('menu.php');
    echo view ('edit_kategori',$parent);
    echo view ('footer.php');
        //echo view "barang", itu dari view, bukan database gudang//
}else if (session()->get('level')>0) {
    return redirect()->to('home/error');
}else{
    return redirect()->to('home/login');
}
}
public function simpan_edit_kategori()
{
    $a=$this->request->getPost('nama_kategori');
        $e=date('Y-m-d H:i:s', time()); // ✅ Use Jakarta timezone
        $f=session()->get('nama_user');
        $id=$this->request->getPost('id');
        $MKasir= new M_kasir;
        $fetch_id= array('id_kategori' =>$id);
        $data = array(
            "nama_kategori"=>$a,
            "updated_at"=>$e,
            "updated_by"=>$f
        );

        $MKasir= new M_kasir;
        $MKasir->edit('kategori',$data, $fetch_id);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user edit to kategori"); // ✅ Logs real nama_user
        }
        return redirect ()->to('home/tabel_kategori');
    }
    public function menu_barang()
    {
        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3 || session()->get('level')==4) {
            $MKasir= new M_kasir;
            $where= ('id_barang');
            $parent['child']=$MKasir->tampil ('barang',$where);

            echo view('header');
            echo view ('menu.php');
            echo view ('menu_barang',$parent);
            echo view ('footer.php');
        }else if (session()->get('level')>0) {
            return redirect()->to('home/error');
        }else{
            return redirect()->to('home/login');
        }
    }
    public function save_cart_session()
    {
    $cart = $this->request->getJSON(true); // get json
    session()->set('cart', $cart); // save to session
    return $this->response->setJSON(['status' => 'ok']);
}

public function pesan_barang()
{
    if (session()->get('level')>0) {
        $cart = session()->get('cart');
        $data['cart'] = $cart;
        return view('header')
        . view('menu')
        . view('form_pemesanan', $data)
        . view('footer');
    } else {
        return redirect()->to('home/login');
    }
}
public function handle_payment()
{
    date_default_timezone_set('Asia/Jakarta');
    $MKasir = new M_kasir;
    $cart = session()->get('cart');

    $nomor_meja = $this->request->getPost('nomor_meja');
    $metode_pembayaran = $this->request->getPost('metode_pembayaran');
    $bayar = $this->request->getPost('bayar');
    $catatan = $this->request->getPost('catatan');

    $grand_total = 0;
    $total_barang = 0;

    $today = date('Y-m-d');
    $datetime_now = date('Y-m-d H:i:s');

    // Generate kode_pemesanan (count per hari + 1)
    $count_today_pemesanan = $MKasir->countTodayPemesanan($today);
    $kode_pemesanan = 'KP-' . date('ymd') . '-' . str_pad($count_today_pemesanan + 1, 3, '0', STR_PAD_LEFT);

    // Generate nomor_nota (count per hari + 1)
    $count_today_nota = $MKasir->countTodayNota($today);
    $nomor_nota = date('ymd') . '-' . str_pad($count_today_nota + 1, 3, '0', STR_PAD_LEFT);

    // Masukkan semua pemesanan
    foreach ($cart as $index => $item) {
        $grand_total += $item['harga'] * $item['jumlah'];
        $total_barang += $item['jumlah'];

        $data_pemesanan = [
            'kode_pemesanan' => $kode_pemesanan,
            'nomor_meja' => $nomor_meja,
            'kode_barang' => $item['id'],
            'jumlah' => $item['jumlah'],
            'catatan' => $catatan[$index] ?? '',
            'id_user' => session()->get('id_user'),
            'tanggal' => $datetime_now, // tanggal harus konsisten
            'status_pemesanan' => 'proses',
            'nomor_nota' => $nomor_nota // pastikan sama
        ];
        $MKasir->input('pemesanan', $data_pemesanan);
    }

    // Masukkan ke tabel nota
    $data_nota = [
        'nomor_nota' => $nomor_nota,
        'grand_total' => $grand_total,
        'metode_pembayaran' => $metode_pembayaran,
        'foto_pembayaran' => '',
        'keterangan' => 'pending',
        'tanggal' => $datetime_now, // konsisten
    ];
    $MKasir->input('nota', $data_nota);

    // Set session untuk upload bukti
    session()->set('nomor_nota', $nomor_nota);
    session()->remove('cart');

    if ($metode_pembayaran == 'Cash') {
        return redirect()->to('home/cash_success');
    } else {
        session()->set('metode_pembayaran', $metode_pembayaran);
        return redirect()->to('home/upload_payment');
    }
}

public function cash_success()
{
    echo view('header');
    echo view('cash_success'); // halaman checkmark
    echo view('footer');
}

public function upload_payment()
{
    echo view('header');
    echo view('upload_payment'); // halaman upload bukti
    echo view('footer');
}
public function submit_payment()
{
    $MKasir = new M_kasir;
    $nomor_nota = session()->get('nomor_nota');

    $file = $this->request->getFile('bukti_transfer');
    if ($file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move('uploads/', $newName);

        // 🛠 Cari id_nota berdasarkan nomor_nota
        $nota = $MKasir->getNotaByNomor($nomor_nota);

        if ($nota) {
            $id_nota = $nota['id_nota']; // ✅ ambil id_nota beneran

            // Update nota pakai id_nota
            $MKasir->updateNota($id_nota, [
                'foto_pembayaran' => $newName,
                'keterangan' => 'pending'
            ]);

            return redirect()->to('home/waiting_verification');
        } else {
            // nomor_nota gak ketemu
            return redirect()->to('home/payment_failed');
        }
    } else {
        return redirect()->to('home/payment_failed');
    }
}


// public function waiting_verification()
// {
//     echo view('header');
//     echo view('waiting_verification'); // halaman tunggu verifikasi
//     echo view('footer');
// }

public function waiting_verification()
{
    $nomor_nota = session()->get('nomor_nota'); // ambil dari session
    $MKasir = new M_kasir;
    $nota = $MKasir->getNotaByNomor($nomor_nota);

    if ($nota) {
        echo view('header');
        echo view('waiting_verification', ['nota' => $nota]); // kirim nota
        echo view('footer');
    } else {
        return redirect()->to('home/payment_failed');
    }
}


public function check_payment_status($id_nota)
{
    $MKasir = new M_kasir;
    $nota = $MKasir->getNotaById($id_nota);

    if ($nota) {
        return $this->response->setJSON([
            'keterangan' => $nota['keterangan']
        ]);
    } else {
        return $this->response->setJSON([
            'keterangan' => 'unknown'
        ]);
    }
}

public function payment_failed()
{
    echo view('header');
    echo view('payment_failed'); // halaman gagal
    echo view('footer');
}
    // In Home.php
public function payment_success()
{
    echo view('header');
    echo view('payment_success'); // halaman sukses
    echo view('footer');

}
public function accept_payment($id_nota)
{
    $MKasir = new M_kasir;
    $id_kasir = session()->get('id_user'); // ambil id_user dari session
 // Ambil nilai grand_total dari nota
    
    $MKasir->updateNota($id_nota, [
        'keterangan' => 'lunas',
        'id_kasir' => $id_kasir,// tambahkan id_kasir
    ]);

    return redirect()->to('home/tabel_nota');
}


public function reject_payment($id_nota)
{
    $MKasir = new M_kasir;
      $id_kasir = session()->get('id_user'); // ambil id_user dari session

      $MKasir->updateNota($id_nota, [
        'keterangan' => 'gagal',
         'id_kasir' => $id_kasir // tambahkan id_kasir
     ]);
      return redirect()->to('home/tabel_nota');
  }
  public function proses_bayar($id_nota)
  {
    $MKasir = new M_kasir;
    // Ambil inputan
    $bayar = $this->request->getPost('bayar');
    $grand_total = $this->request->getPost('grand_total');

    // Bersihkan titik pemisah ribuan dulu
    $bayar = str_replace('.', '', $bayar);
    $grand_total = str_replace('.', '', $grand_total);

    // Pastikan angka
    $bayar = (int) $bayar;
    $grand_total = (int) $grand_total;

    // Hitung kembali
    $kembali = $bayar - $grand_total;

    $data = [
        'bayar' => $bayar,
        'kembali' => $kembali,
        'keterangan' => 'lunas',
        'id_kasir' => session()->get('id_user'),
    ];
    
    $MKasir->updateNota_manual($id_nota, $data);

    return redirect()->to('home/tabel_nota');
}
public function pemesanan()
{
    if (in_array(session()->get('level'), [1, 2, 3, 4])) {
        $MKasir = new M_kasir;
        date_default_timezone_set('Asia/Jakarta');

        $filter_date_start = $this->request->getGet('tanggal_mulai');
        $filter_date_end = $this->request->getGet('tanggal_selesai');
        $filter_time_start = $this->request->getGet('waktu_mulai');
        $filter_time_end = $this->request->getGet('waktu_selesai');
        $filter_status = $this->request->getGet('status_pemesanan');
        $filter_keterangan = $this->request->getGet('keterangan');

        $where = ' WHERE 1=1';

        // Level-based filters
        if (session()->get('level') == 4) { // Customer
            $id_user = session()->get('id_user');
            $today = date('Y-m-d');
            $where .= ' AND pemesanan.id_user = "' . $id_user . '"';
            $where .= ' AND DATE(pemesanan.tanggal) = "' . $today . '"';
        } elseif (session()->get('level') == 2) { // Kasir
            $today = date('Y-m-d');
            $where .= ' AND DATE(pemesanan.tanggal) = "' . $today . '"';
        }
        // Level 1 & 3 no extra limit

        // Flexible Date Filter
        if (!empty($filter_date_start) && !empty($filter_date_end)) {
            $where .= ' AND DATE(pemesanan.tanggal) BETWEEN "' . $filter_date_start . '" AND "' . $filter_date_end . '"';
        } elseif (!empty($filter_date_start)) {
            $where .= ' AND DATE(pemesanan.tanggal) = "' . $filter_date_start . '"';
        }

        // Flexible Time Filter
        if (!empty($filter_time_start) && !empty($filter_time_end)) {
            $where .= ' AND TIME(pemesanan.tanggal) BETWEEN "' . $filter_time_start . '" AND "' . $filter_time_end . '"';
        } elseif (!empty($filter_time_start)) {
            $where .= ' AND TIME(pemesanan.tanggal) >= "' . $filter_time_start . '"';
        }

        // Status Filter
        if (!empty($filter_status)) {
            $where .= ' AND pemesanan.status_pemesanan = "' . $filter_status . '"';
        }

        // Keterangan Filter
        if (!empty($filter_keterangan)) {
            $where .= ' AND nota.keterangan = "' . $filter_keterangan . '"';
        }

        // Fetch data
        $parent['child'] = $MKasir->join5('pemesanan', 'barang', 'user', 'nota',
            'pemesanan.kode_barang = barang.id_barang',
            'pemesanan.id_user = user.id_user',
            'pemesanan.nomor_nota = nota.nomor_nota',
            $where
        );

        // Fetch order items
        foreach ($parent['child'] as &$order) {
            $order['items'] = $MKasir->getItemsByOrder($order['nomor_nota']);
        }

        // Pass filters back to view
        $parent['filter_date_start'] = $filter_date_start;
        $parent['filter_date_end'] = $filter_date_end;
        $parent['filter_time_start'] = $filter_time_start;
        $parent['filter_time_end'] = $filter_time_end;
        $parent['filter_status'] = $filter_status;
        $parent['filter_keterangan'] = $filter_keterangan;

        // Save filtered result for printing
        session()->set('filtered_orders', $parent['child']);

        echo view('header');
        echo view('menu');
        echo view('pemesanan', $parent);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}

public function update_status()
{
 $MKasir = new M_kasir;
 $nomor_nota = $this->request->getPost('nomor_nota');
 $status_pemesanan = $this->request->getPost('status_pemesanan');

    // Update lewat model
 $this->MKasir->updateStatusPemesanan($nomor_nota, $status_pemesanan);

 return redirect()->to(base_url('home/Pemesanan'))->with('message', 'Status berhasil diupdate.');
}


 public function cetak_all_pemesanan()
{
    if (in_array(session()->get('level'), [1, 2, 3, 4])) {
        $MKasir = new M_kasir;

        $filtered_orders = session()->get('filtered_orders');

        if (!$filtered_orders) {
            return redirect()->to('home/pemesanan')->with('error', 'Tidak ada data yang bisa dicetak.');
        }

        $parent['child'] = $filtered_orders;

        echo view('cetak_all_pemesanan', $parent);
    } else {
        return redirect()->to('home/login');
    }
}

public function cetak_pemesanan($nomor_nota)
{
    if (in_array(session()->get('level'), [1, 2, 3, 4])) {
        $MKasir = new M_kasir;

        $nota = $MKasir->getNotaByNomor2($nomor_nota);
        $items = $MKasir->getItemsByOrder($nomor_nota);

        if (!$nota) {
            return redirect()->to('home/pemesanan')->with('error', 'Nota tidak ditemukan.');
        }

        $data['nota'] = $nota;
        $data['items'] = $items;

        echo view('cetak_pemesanan', $data);
    } else {
        return redirect()->to('home/login');
    }
}
public function laporan_keuangan()
{
    if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3) {
        $MKasir = new M_kasir;
        echo view('header');
        echo view('menu.php');
        echo view('laporan_keuangan');
        echo view('footer.php');
    } else {
        return redirect()->to('home/error');
    }
}
public function excel_keuangan()
{
    $MKasir = new M_kasir;

    $awal = $this->request->getPost('tanggal_awal') . ' 00:00:00';
    $akhir = $this->request->getPost('tanggal_akhir') . ' 23:59:59';

    // Getting the laporan
    $parent['laporan'] = $MKasir->getLaporanKeuangan($awal, $akhir);
    $parent['tanggal_awal'] = $awal;
    $parent['tanggal_akhir'] = $akhir;

    // Check if laporan is empty
    if (empty($parent['laporan'])) {
        echo "No data available for the selected date range.";
        return;
    }

    // Calculate total values
    $laporan = $parent['laporan'];
    $total_jumlah_terjual = 0;
    $total_total_pendapatan = 0;
    $total_modal = 0;
    $total_laba = 0;

    foreach ($laporan as $row) {
        $total_jumlah_terjual += $row['jumlah_terjual'];
        $total_total_pendapatan += $row['total_pendapatan'];
        $total_modal += $row['modal'];
        $total_laba += $row['laba'];
    }

    $parent['totals'] = [
        'jumlah_terjual' => $total_jumlah_terjual,
        'total_pendapatan' => $total_total_pendapatan,
        'modal' => $total_modal,
        'laba' => $total_laba
    ];

    // Return the view for excel report
    echo view('excel_keuangan', $parent);
}


public function tabel_barang()
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;
            // Get sorting parameter from URL (e.g., home/tabel_barang?sort=nama_barang&order=ASC)
            $sort = $this->request->getGet('sort') ?? 'id_barang'; // Default sorting by ID
            $order = $this->request->getGet('order') ?? 'DESC'; // Default order DESC

            $parent['child'] = $MKasir->join_barang_kategori([], $sort, $order);


            echo view('header');
            echo view ('menu.php');
            echo view ('tabel_barang',$parent);
            echo view ('footer.php');
        }else if (session()->get('level')>0) {
            return redirect()->to('home/error');
        }else{
            return redirect()->to('home/login');
        }
    }
    public function tabel_barang_deleted()
    {
        if (session()->get('level')==3) {
            $MKasir= new M_kasir;

            // Get sorting parameter from URL (e.g., home/tabel_barang?sort=nama_barang&order=ASC)
            $sort = $this->request->getGet('sort') ?? 'id_barang'; // Default sorting by ID
            $order = $this->request->getGet('order') ?? 'DESC'; // Default order DESC

            $parent['deleted_items'] = $MKasir->get_deleted_items('barang', 'id_barang', $sort, $order);

            echo view('header');
            echo view ('menu.php');
            echo view ('tabel_barang_deleted',$parent);
            echo view ('footer.php');
        }else if (session()->get('level')>0) {
            return redirect()->to('home/error');
        }else{
            return redirect()->to('home/login');
        }
    }
    public function tambah_barang()
    {
        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
            $MKasir= new M_kasir;
            $where= ('id_kategori');
            $parent['child']=$MKasir->tampil('kategori',$where);
            echo view('header');
            echo view ('menu.php');
            echo view ('tambah_barang.php',$parent);
            echo view ('footer.php');
        }else if (session()->get('level')>0) {
            return redirect()->to('home/error');
        }else{
            return redirect()->to('home/login');
        }
    }
    public function simpan_tambah_barang()
    {
         date_default_timezone_set('Asia/Jakarta');
        $MKasir= new M_kasir;
        $data = array(
            'kode_barang'=> $this->request->getPost('kode_barang'),
            'nama_barang'=> $this->request->getPost('nama_barang'),
            'deskripsi'=> $this->request->getPost('deskripsi'),
            'kategori'=> $this->request->getPost('kategori'),
             'harga_satuan'=> str_replace('.', '', $this->request->getPost('harga_satuan')), // Remove thousands separator
              'harga_mentah'=> str_replace('.', '', $this->request->getPost('harga_mentah')), // Remove thousands separator
              'stok'=> $this->request->getPost('stok'),
              'foto'=> $this->request->getPost('file'),
              'created_at'  => date('Y-m-d H:i:s', time()),
              'created_by'  => session()->get('nama_user')
          );


        $file = $_FILES["file"];
        $validExtensions = ["jpg", "png", "jpeg"];
        $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
        $timestamp = time(); 
        $newFileName = $timestamp . "_" . $file["name"]; 
        move_uploaded_file($file["tmp_name"], "foto/" . $newFileName);
        $data['foto'] = $newFileName; 


        $MKasir= new M_kasir;
        $MKasir->input('barang',$data);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user successfully added '{$data['nama_barang']}' to barang"); // ✅ Logs real nama_user
        }
        return redirect ()->to('home/tabel_barang');
    }
    // public function hapus_barang($id)
    // {
    //     $MKasir= new M_kasir;
    //     $fetch_id= array('id_barang' =>$id);
    //     $parent['child']=$MKasir->hapus('barang',$fetch_id);
    //     return redirect()->to('home/tabel_barang');
    // }
    //SOFT DELETE//
    public function hapus_barang($id) {
        $MKasir = new M_kasir;
        $MKasir->soft_delete('barang', 'id_barang', $id); // Soft delete by setting status = 0
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user deleted barang with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_barang');
    }

    public function restore_barang($id) {
        $MKasir = new M_kasir;
        $MKasir->restore('barang', 'id_barang', $id); // Restore by setting status = NULL
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored barang with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_barang_deleted');
    }

    public function delete_permanently($id) {
        $MKasir = new M_kasir;
        $MKasir->hard_delete('barang', 'id_barang', $id); // Mark as permanently deleted (status = 1)
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user permanently delete barang with ID '$id'"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_barang_deleted');
    }
    public function restore_all_barang() {
        $MKasir = new M_kasir;
    $MKasir->restore_all('barang'); // Restore all soft-deleted records
    $nama_user = session()->get('nama_user');
    if ($nama_user) {
            $this->MKasir->insertLog("$nama_user restored all barang"); // ✅ Logs real nama_user
        }
        return redirect()->to('home/tabel_barang_deleted')->with('message', 'All barang have been restored!');
    }
    public function detail_barang($id)
    {
        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
            $MKasir= new M_kasir;
            $fetch_id= array('id_barang' =>$id);
            $parent['child']=$MKasir->getWhere('barang',$fetch_id);
            echo view('header');
            echo view ('menu.php');
            echo view ('detail_barang',$parent);
            echo view ('footer.php');
        //echo view "barang", itu dari view, bukan database gudang//
        }else if (session()->get('level')>0) {
            return redirect()->to('home/error');
        }else{
            return redirect()->to('home/login');
        }
    }

    public function edit_barang($id)
    {
        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
            $MKasir= new M_kasir;
            $fetch_id= array('id_barang' =>$id);
            $parent['child']=$MKasir->getWhere('barang',$fetch_id);
            echo view('header');
            echo view ('menu.php');
            echo view ('edit_barang',$parent);
            echo view ('footer.php');
        //echo view "barang", itu dari view, bukan database gudang//
        }else if (session()->get('level')>0) {
            return redirect()->to('home/error');
        }else{
            return redirect()->to('home/login');
        }
    }
    public function simpan_edit_barang()
    {
        $a=$this->request->getPost('kode_barang');
        $b=$this->request->getPost('nama_barang');
        $c=$this->request->getPost('deskripsi');
        $d=$this->request->getPost('kategori');
        $e=$this->request->getPost('harga_satuan');
        $j=$this->request->getPost('harga_mentah');
        $f=$this->request->getPost('stok');
        $h=date('Y-m-d H:i:s', time());
        $i=session()->get('nama_user');
        $id=$this->request->getPost('id');

        $MKasir= new M_kasir;
        $fetch_id= array('id_barang' =>$id);
        $data = array(
            "kode_barang"=>$a,
            "nama_barang"=>$b,
            "deskripsi"=>$c,
            "kategori"=>$d,
            "harga_satuan"=>$e,
            "harga_mentah"=>$j,
            "stok"=>$f,
            "updated_at"=>$h,
            "updated_by"=>$i
        );

        $MKasir= new M_kasir;
        $MKasir->edit('barang',$data, $fetch_id);
        $nama_user = session()->get('nama_user');
        if ($nama_user) {
            $this->MKasir->insertLog("$nama_user edit '{$data['nama_barang']}' to barang"); // ✅ Logs real nama_user
        }
        return redirect ()->to('home/tabel_barang');
    }
    public function tabel_nota()
    {
        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
            $MKasir = new M_kasir;

        $parent['child'] = $MKasir->joinNota(); // ambil semua, tanpa filter status

        echo view('header');
        echo view('menu.php');
        echo view('tabel_nota', $parent);
        echo view('footer.php');
    } else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    } else {
        return redirect()->to('home/login');
    }
}
public function detail_nota($id)
{
    if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3) {
        $MKasir = new M_kasir;
        
        // Bungkus object ke dalam array
        $data = ['data' => $MKasir->joinNotaDetail($id)];

        // If no data is found, handle it gracefully
        if (!$data['data']) {
            return redirect()->to('/home/error')->with('error', 'Nota not found.');
        }

        echo view('header');
        echo view('menu.php');
        echo view('detail_nota', $data);
        echo view('footer.php');
    } else {
        return redirect()->to('home/login');
    }
}




public function lampirkan_gambar($id)
{
    $MKasir = new M_kasir;
    $fetch_id= array('id_nota' =>$id);
    $parent['child']=$MKasir->getWhere('nota',$fetch_id);
    echo view('header');
    echo view('lampirkan_gambar', $parent);
    echo view('footer');
}

public function tabel_pemesanan()
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir= new M_kasir;
        $where= ('id_pemesanan');
        $parent['child']=$MKasir->join4('pemesanan','barang','user','nota', 'pemesanan.kode_barang = barang.id_barang', 'pemesanan.id_user = user.id_user', 'pemesanan.nomor_nota = nota.nomor_nota',$where);

        echo view('header');
        echo view ('menu.php');
        echo view ('tabel_pemesanan',$parent);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}
public function detail_pemesanan($id_pemesanan)
{
    if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {
        $MKasir = new M_kasir;

        $data['pemesanan'] = $MKasir->getDetailPemesanan($id_pemesanan);

        if ($data['pemesanan']) {
            echo view('header');
            echo view('menu');
            echo view('detail_pemesanan', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/tabel_pemesanan')->with('error', 'Data tidak ditemukan');
        }
    } else {
        return redirect()->to('home/login');
    }
}

public function printNota($id_nota)
{
    $MKasir = new M_kasir;

    // Fetch the nota details using id_nota
    $data = $this->MKasir->joinNotaDetail2($id_nota);

    // Fetch the items for the nota using the adjusted query
    $items = $this->MKasir->getItemsForNota($id_nota);

    // Pass both data and items to the view
    return view('print_nota', [
        'data' => $data,
        'items' => $items
    ]);
}



public function pengaturan()
{
    if (session()->get('level')==3) {

        $db = db_connect();
        $pengaturan = $db->table('pengaturan_app')->get()->getRow();
        echo view('header');
        echo view ('menu.php');
        return view('pengaturan', ['pengaturan' => $pengaturan]);
        echo view ('footer.php');
    }else if (session()->get('level')>0) {
        return redirect()->to('home/error');
    }else{
        return redirect()->to('home/login');
    }
}

public function simpan_pengaturan()
{
    $db = db_connect();
    $builder = $db->table('pengaturan_app');

    $data = [
        'judul' => $this->request->getPost('judul'),
        'nama_app' => $this->request->getPost('nama_app'),
    ];

    // Proses Upload Logo
    $logo = $this->request->getFile('logo');
    if ($logo && $logo->isValid() && !$logo->hasMoved()) {
        $newName = $logo->getRandomName();
        $logo->move('uploads/', $newName); // Simpan ke public/uploads/

        // Ambil data pengaturan yang sudah ada
        $pengaturan = $builder->get()->getRow();
        if (!empty($pengaturan->logo) && file_exists('uploads/' . $pengaturan->logo)) {
            unlink('uploads/' . $pengaturan->logo); // Hapus logo lama
        }

        $data['logo'] = $newName;
    }

    // Update atau insert data
    if ($builder->countAll() > 0) {
        $builder->update($data);
    } else {
        $builder->insert($data);
    }

    return redirect()->to('home/pengaturan')->with('success', 'Pengaturan berhasil disimpan.');
}
}
