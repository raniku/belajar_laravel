<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AbsenModel;
use App\Models\TimelineModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class AuthController extends Controller
{
    public function login(Request $request){
        
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
 
        $credentials = request(['email', 'password']);
 
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message'=> 'Invalid email or password'
            ], 401);
        }
 
        $user = $request->user();
 
        $token = $user->createToken('Access Token');
 
        $user->access_token = $token->accessToken;
 
        return response()->json([
            "user"=>$user
        ], 200);
    }

    public function signup(Request $request){
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        
        $user = new User([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
 
        $user->save();
 
        return response()->json([
            "message" => "User registered successfully"
        ], 201);
    }

    public function addjadwal(Request $request){

        $addjadwal = DB::select('SELECT db_tahunpelajaran.id_tahunpelajaran, db_tahunpelajaran.nama_tahunpelajaran, 
            COUNT(db_jadwalkegiatan.id_jadwalkegiatan) AS jumlah FROM db_tahunpelajaran 
            LEFT JOIN db_jadwalkegiatan ON db_tahunpelajaran.id_tahunpelajaran = db_jadwalkegiatan.id_tahunpelajaran 
            WHERE db_tahunpelajaran.`status` = "aktif" GROUP BY db_tahunpelajaran.id_tahunpelajaran, 
            db_tahunpelajaran.nama_tahunpelajaran');

        foreach ($addjadwal as $a) {
            
            $request->validate([
                'nama_jadwalkegiatan' => 'required|string',
                'tanggal' => 'required|date_format:Y-m-d',
                'waktu' => 'required|date_format:H:i:s',
                'nama_tempat' => 'required|string',
                'alamat' => 'required|string',
                'catatan' => 'required|string'
            ]);

            $tanggal = $request->tanggal." ".$request->waktu;
            $jumlah = $a->jumlah + 1;
            $timeline = new TimelineModel([
                'id_jadwalkegiatan'=>substr($a->nama_tahunpelajaran,2,2)."".substr($a->nama_tahunpelajaran,7,2).".".$jumlah,
                'id_tahunpelajaran'=>$a->id_tahunpelajaran,
                'nama_jadwalkegiatan'=>$request->nama_jadwalkegiatan,
                'waktu'=>date("Y-m-d H:i:s", strtotime($tanggal)),
                'nama_tempat'=>$request->nama_tempat,
                'alamat'=>$request->nama_tempat,
                'catatan'=>$request->nama_tempat
            ]);
     
            $timeline->save();
        }
 
        return response()->json([
            "message" => "Data Berhasil Disimpan"
        ], 201);
    }

    public function logout(Request $request){
        $request->user()->token()->revoke(); 
        return response()->json([
            "message"=>"User logged out successfully"
        ], 200);
    }

    public function schedule(){
        
        $schedule = DB::select('SELECT db_jadwalkegiatan.nama_jadwalkegiatan, DATE_FORMAT(db_jadwalkegiatan.waktu, "%d %b %Y") AS tanggal, 
                TIME(db_jadwalkegiatan.waktu) AS waktu, db_jadwalkegiatan.nama_tempat, 
                db_jadwalkegiatan.alamat, db_jadwalkegiatan.catatan FROM db_jadwalkegiatan 
                Inner Join db_tahunpelajaran ON db_jadwalkegiatan.id_tahunpelajaran = db_tahunpelajaran.id_tahunpelajaran 
                WHERE db_tahunpelajaran.status = "aktif" ORDER BY db_jadwalkegiatan.waktu DESC');
        
        //return response()->json([
            //"schedule"=>$schedule
        //], 200);

        return response()->json(
            $schedule
        , 200);
    }

    public function myteacher(){
        
        $myteacher = DB::select('SELECT db_guru.id_guru, db_guru.nama_guru, db_guru.no_telp, db_guru.tempat_lahir, 
            DATE_FORMAT(db_guru.tanggal_lahir, "%d %b %Y") AS tanggal_lahir, db_guru.alamat FROM db_guru ORDER BY db_guru.no_telp ASC');
        
        
        return response()->json(
            $myteacher
        , 200);
    }

    public function mystudent(Request $request){
        
        $mystudent = DB::select('SELECT db_kelassiswa.id_siswa, db_siswa.nama_siswa, db_siswa.nik, db_siswa.no_telp, 
            db_siswa.jk, db_siswa.tempat_lahir, DATE_FORMAT(db_siswa.tanggal_lahir, "%d %b %Y") AS tanggal_lahir, 
            db_siswa.alamat, db_siswa.nama_ayah, db_siswa.nama_ibu, db_siswa.pekerjaan_ayah, db_siswa.pekerjaan_ibu, 
            db_kelas.nama_kelas FROM db_kelassiswa Inner Join db_siswa ON db_kelassiswa.id_siswa = db_siswa.id_siswa 
            Inner Join db_kelas ON db_kelassiswa.id_kelas = db_kelas.id_kelas 
            Inner Join db_tahunpelajaran ON db_kelassiswa.id_tahunpelajaran = db_tahunpelajaran.id_tahunpelajaran 
            WHERE db_tahunpelajaran.status =  "aktif" AND db_kelas.nama_kelas = ? ORDER BY db_siswa.nama_siswa ASC', 
            [$request->nama_kelas]);
        
        
        return response()->json(
            $mystudent
        , 200);
    }

    public function absen(Request $request){
        
        $absen = DB::select('SELECT db_kelassiswa.id_tahunpelajaran, db_kelassiswa.id_siswa, db_kelassiswa.id_kelas, db_siswa.nama_siswa 
            FROM db_kelassiswa Inner Join db_siswa ON db_kelassiswa.id_siswa = db_siswa.id_siswa 
            Inner Join db_kelas ON db_kelassiswa.id_kelas = db_kelas.id_kelas 
            Inner Join db_tahunpelajaran ON db_kelassiswa.id_tahunpelajaran = db_tahunpelajaran.id_tahunpelajaran 
            WHERE db_tahunpelajaran.status =  "aktif" AND db_kelas.nama_kelas = ? 
            ORDER BY db_siswa.nama_siswa ASC', 
            [str_replace('Kelas ','',$request->nama_kelas)]);

        $outputs = array(); 
        foreach ($absen as $a) {
            $output = array(); 
            $output['nama_siswa'] = $a->nama_siswa;

            $days = DB::select('SELECT tanggal, keterangan FROM db_absensiswa 
                WHERE id_tahunpelajaran = ? AND id_kelas = ? AND id_siswa = ? 
                AND MONTHNAME(db_absensiswa.tanggal) = ? ORDER BY db_absensiswa.tanggal', 
                [$a->id_tahunpelajaran, $a->id_kelas, $a->id_siswa, $request->nama_bulan]);
                    
                $tanggals = array(); 
                foreach ($days as $b) {
                    $tanggal = array(); 
                    $tanggal['tanggal'] = date("j", strtotime($b->tanggal));
                    $tanggal['keterangan'] = $b->keterangan;
                    array_push($tanggals, $tanggal);
                }                    
                
                for($i=1;$i<=31;$i++){
                    $key = array_search($i, array_column($tanggals, 'tanggal'));
                    if($key!==false){
                        $output['tanggal'.$i] = $tanggals[$key]['keterangan'];
                    }else{
                        $date = $request->nama_bulan.' '.$i.' 20'.substr($a->id_siswa, 0, 2);
                        if(date('N', strtotime($date))>5){
                            $output['tanggal'.$i] = "L";  
                        }else{
                            //$bulan=checkdate(date('n', strtotime($date)),$i,date('Y', strtotime($date)));
                            if(date('F', strtotime($date)) != $request->nama_bulan){
                                $output['tanggal'.$i] = "N";
                            }else{
                                $output['tanggal'.$i] = "H";
                            }                           
                        }             
                        
                    }
                }                
            array_push($outputs, $output);
        }
        
        return response()->json(
            $outputs
        , 200);
    }

    public function myabsen(Request $request){
        
        $absen = DB::select('SELECT
                    a.id_tahunpelajaran, b.id_kelas, db_siswa.id_siswa, db_siswa.nama_siswa, 
                    (SELECT CONCAT(db_absensiswa.keterangan,". Keterangan : ",db_absensiswa.keterangan2) FROM db_absensiswa 
                    WHERE db_absensiswa.id_tahunpelajaran = a.id_tahunpelajaran AND 
                    db_absensiswa.id_kelas = b.id_kelas AND db_absensiswa.id_siswa = b.id_siswa AND db_absensiswa.tanggal = ?) 
                    AS keterangan FROM db_tahunpelajaran a
                    INNER JOIN db_kelassiswa b ON a.id_tahunpelajaran = b.id_tahunpelajaran
                    INNER JOIN db_kelas ON b.id_kelas = db_kelas.id_kelas
                    INNER JOIN db_siswa ON b.id_siswa = db_siswa.id_siswa
                    WHERE `status` = "aktif" AND db_kelas.nama_kelas = ? ORDER BY db_siswa.nama_siswa ASC',
                    [$request->tanggal, str_replace('Kelas ','',$request->nama_kelas)]);
        
        
        return response()->json(
            $absen
        , 200);
    }

    public function addabsen(Request $request){        

        $lihatabsen = DB::select('SELECT db_absensiswa.id_absensiswa FROM db_absensiswa 
            WHERE db_absensiswa.id_kelas = ? AND db_absensiswa.id_siswa = ? AND db_absensiswa.tanggal = ?',
            [$request->id_kelas, $request->id_siswa, $request->tanggal]);
        
        $row = null;
        foreach ($lihatabsen as $l) {
            $row =$l->id_absensiswa;
        }   
        
        if(empty($row)){
            
            $addabsen = DB::select('SELECT db_tahunpelajaran.id_tahunpelajaran, db_tahunpelajaran.nama_tahunpelajaran, 
                COUNT(db_absensiswa.id_absensiswa) AS jumlah FROM db_tahunpelajaran 
                LEFT JOIN db_absensiswa ON db_tahunpelajaran.id_tahunpelajaran = db_absensiswa.id_tahunpelajaran 
                WHERE db_tahunpelajaran.`status` = "aktif" GROUP BY db_tahunpelajaran.id_tahunpelajaran, 
                db_tahunpelajaran.nama_tahunpelajaran');

            foreach ($addabsen as $a) {    
                $payperiodstart = substr($a->nama_tahunpelajaran,0,4)."-07-01";
                $payperiodend = substr($a->nama_tahunpelajaran,5,4)."-06-30";

                $request->validate([
                    'id_kelas' => 'required|string',
                    'id_siswa' => 'required|string',
                    'tanggal' => 'required|date|date_format:Y-m-d|after_or_equal:'.$payperiodstart.'|before_or_equal:'.$payperiodend,
                    'keterangan' => 'required|string|min:1|max:1',
                    'keterangan2' => 'required|string'
                ]);

                $jumlah = $a->jumlah + 1;
                $absen = new AbsenModel([
                    'id_absensiswa'=>substr($a->nama_tahunpelajaran,2,2)."".substr($a->nama_tahunpelajaran,7,2).".".$jumlah,
                    'id_tahunpelajaran'=>$a->id_tahunpelajaran,
                    'id_kelas'=>$request->id_kelas,
                    'id_siswa'=>$request->id_siswa,
                    'tanggal'=>date("Y-m-d", strtotime($request->tanggal)),
                    'keterangan'=>$request->keterangan,
                    'keterangan2'=>$request->keterangan2
                ]);

                $absen->save();
            }               

        }else{

            $request->validate([
                'keterangan' => 'required|string|min:1|max:1',
                'keterangan2' => 'required|string'
            ]);

            $absen = AbsenModel::find($row);
            $absen->keterangan = $request->keterangan;
            $absen->keterangan2 = $request->keterangan2;
            $absen->save();    

        }

        $absen = DB::select('SELECT
                    a.id_tahunpelajaran, b.id_kelas, db_siswa.id_siswa, db_siswa.nama_siswa, 
                    (SELECT CONCAT(db_absensiswa.keterangan,". Keterangan : ",db_absensiswa.keterangan2) FROM db_absensiswa 
                    WHERE db_absensiswa.id_tahunpelajaran = a.id_tahunpelajaran AND 
                    db_absensiswa.id_kelas = b.id_kelas AND db_absensiswa.id_siswa = b.id_siswa AND db_absensiswa.tanggal = ?) 
                    AS keterangan FROM db_tahunpelajaran a
                    INNER JOIN db_kelassiswa b ON a.id_tahunpelajaran = b.id_tahunpelajaran
                    INNER JOIN db_kelas ON b.id_kelas = db_kelas.id_kelas
                    INNER JOIN db_siswa ON b.id_siswa = db_siswa.id_siswa
                    WHERE `status` = "aktif" AND db_kelas.id_kelas = ? ORDER BY db_siswa.nama_siswa ASC',
                    [$request->tanggal, $request->id_kelas]);

        return response()->json(
            $absen
        , 200);

    }
 
    public function index(){
        echo "Hello World";
    }

}
