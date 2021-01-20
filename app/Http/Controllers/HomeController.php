<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->HomeModel = new HomeModel;
    }

    public function index()
    {
        return view('v_home');
    }

    public function indexGuru()
    {
        $data = [
            'guru' => $this->HomeModel->allData('guru')
        ];
        
        return view('guru/v_guru', $data);
    }

    public function indexSiswa()
    {
        $data = [
            'guru' => $this->HomeModel->allData('siswa')
        ];
        
        return view('siswa/v_siswa', $data);
    }

    public function detail($id, $id_detail)
    {
        if(!$this->HomeModel->detailData($id, $id_detail)){
            abort('404');
        }
        $data = [
            'guru' => $this->HomeModel->detailData($id, $id_detail)
        ];
        
        return view($id.'/v_detail'.$id, $data);
    }

    public function add($id)
    {
        return view($id.'/v_add'.$id);
    }

    public function insert($id)
    {
        if ($id == "siswa") {

            Request()->validate([
                'id_siswa' => 'required|unique:db_siswa,id_siswa|min:8|max:8',
                'nama_siswa' => 'required',
                'nik' => 'required',
                'no_telp' => 'required',
                'jk' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'nama_ayah' => 'required',
                'nama_ibu' => 'required',
                'pekerjaan_ayah' => 'required',
                'pekerjaan_ibu' => 'required',
                'foto_siswa' => 'required|mimes:jpg,jpeg|max:50'
            ], [
                'id_siswa.required' => 'Tidak Boleh Kosong !!',
                'id_siswa.unique' => 'ID Siswa Ini Sudah Ada !!',
                'id_siswa.min' => 'Min 8 Karakter',
                'id_siswa.max' => 'Max 8 Karakter',
                'nik.required' => 'Tidak Boleh Kosong !!',
                'nama_siswa.required' => 'Tidak Boleh Kosong !!',
                'jk.required' => 'Tidak Boleh Kosong !!',
                'no_telp.required' => 'Tidak Boleh Kosong !!',
                'tempat_lahir.required' => 'Tidak Boleh Kosong !!',
                'tanggal_lahir.required' => 'Tidak Boleh Kosong !!',
                'alamat.required' => 'Tidak Boleh Kosong !!',
                'nama_ayah.required' => 'Tidak Boleh Kosong !!',
                'nama_ibu.required' => 'Tidak Boleh Kosong !!',
                'pekerjaan_ayah.required' => 'Tidak Boleh Kosong !!',
                'pekerjaan_ibu.required' => 'Tidak Boleh Kosong !!',
                'foto_siswa.required' => 'Tidak Boleh Kosong !!',
                'foto_siswa.max' => 'Maximal ukuran file 50 KB'
            ]);
    
            $file = Request()->foto_siswa;
            $fileName = Request()->id_siswa.'.jpg';
            $file->move(public_path('foto'), $fileName);
    
            $data = [
                'id_siswa' => Request()->id_siswa,
                'nama_siswa' => Request()->nama_siswa,
                'nik' => Request()->nik,
                'no_telp' => Request()->no_telp,
                'jk' => Request()->jk,
                'tempat_lahir' => Request()->tempat_lahir,
                'tanggal_lahir' => Request()->tanggal_lahir,
                'alamat' => Request()->alamat,
                'nama_ayah' => Request()->nama_ayah,
                'nama_ibu' => Request()->nama_ibu,
                'pekerjaan_ayah' => Request()->pekerjaan_ayah,
                'pekerjaan_ibu' => Request()->pekerjaan_ibu
            ];

        }elseif ($id == "guru") {
            
            Request()->validate([
                'id_guru' => 'required|unique:db_guru,id_guru|min:8|max:8',
                'nama_guru' => 'required',
                'no_telp' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'pendidikan' => 'required',
                'foto_guru' => 'required|mimes:jpg,jpeg|max:50'
            ], [
                'id_guru.required' => 'Tidak Boleh Kosong !!',
                'id_guru.unique' => 'ID Guru Ini Sudah Ada !!',
                'id_guru.min' => 'Min 8 Karakter',
                'id_guru.max' => 'Max 8 Karakter',
                'nama_guru.required' => 'Tidak Boleh Kosong !!',
                'no_telp.required' => 'Tidak Boleh Kosong !!',
                'tempat_lahir.required' => 'Tidak Boleh Kosong !!',
                'tanggal_lahir.required' => 'Tidak Boleh Kosong !!',
                'alamat.required' => 'Tidak Boleh Kosong !!',
                'pendidikan.required' => 'Tidak Boleh Kosong !!',
                'foto_guru.required' => 'Tidak Boleh Kosong !!',
                'foto_guru.max' => 'Maximal ukuran file 50 KB'
            ]);
    
            $file = Request()->foto_guru;
            $fileName = Request()->id_guru.'.jpg';
            $file->move(public_path('foto'), $fileName);
    
            $data = [
                'id_guru' => Request()->id_guru,
                'nama_guru' => Request()->nama_guru,
                'no_telp' => Request()->no_telp,
                'tempat_lahir' => Request()->tempat_lahir,
                'tanggal_lahir' => Request()->tanggal_lahir,
                'alamat' => Request()->alamat,
                'pendidikan' => Request()->pendidikan
            ];

        }
        
        $this->HomeModel->insertData($id, $data);
        return redirect()->route($id)->with('toast_success', 'Data Berhasil Ditambahkan !');
    }

    public function edit($id, $id_edit)
    {
        if(!$this->HomeModel->detailData($id, $id_edit)){
            abort('404');
        }
        $data = [
            'guru' => $this->HomeModel->detailData($id, $id_edit)
        ];

        return view($id.'/v_edit'.$id, $data);
    }

    public function update($id, $id_update)
    {
        if ($id == "siswa") {

            Request()->validate([
                'id_siswa' => 'required|min:8|max:8',
                'nama_siswa' => 'required',
                'nik' => 'required',
                'no_telp' => 'required',
                'jk' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'nama_ayah' => 'required',
                'nama_ibu' => 'required',
                'pekerjaan_ayah' => 'required',
                'pekerjaan_ibu' => 'required',
                'foto_siswa' => 'mimes:jpg,jpeg|max:50'
            ], [
                'id_siswa.required' => 'Tidak Boleh Kosong !!',
                'id_siswa.min' => 'Min 8 Karakter',
                'id_siswa.max' => 'Max 8 Karakter',
                'nik.required' => 'Tidak Boleh Kosong !!',
                'nama_siswa.required' => 'Tidak Boleh Kosong !!',
                'jk.required' => 'Tidak Boleh Kosong !!',
                'no_telp.required' => 'Tidak Boleh Kosong !!',
                'tempat_lahir.required' => 'Tidak Boleh Kosong !!',
                'tanggal_lahir.required' => 'Tidak Boleh Kosong !!',
                'alamat.required' => 'Tidak Boleh Kosong !!',
                'nama_ayah.required' => 'Tidak Boleh Kosong !!',
                'nama_ibu.required' => 'Tidak Boleh Kosong !!',
                'pekerjaan_ayah.required' => 'Tidak Boleh Kosong !!',
                'pekerjaan_ibu.required' => 'Tidak Boleh Kosong !!',
                'foto_siswa.required' => 'Tidak Boleh Kosong !!',
                'foto_siswa.max' => 'Maximal ukuran file 50 KB'
            ]);

            if (Request()->foto_siswa <> ""){
                $file = Request()->foto_siswa;
                $fileName = Request()->id_siswa.'.jpg';
                $file->move(public_path('foto'), $fileName);
            }else{

            }    
    
            $data = [
                'id_siswa' => Request()->id_siswa,
                'nama_siswa' => Request()->nama_siswa,
                'nik' => Request()->nik,
                'no_telp' => Request()->no_telp,
                'jk' => Request()->jk,
                'tempat_lahir' => Request()->tempat_lahir,
                'tanggal_lahir' => Request()->tanggal_lahir,
                'alamat' => Request()->alamat,
                'nama_ayah' => Request()->nama_ayah,
                'nama_ibu' => Request()->nama_ibu,
                'pekerjaan_ayah' => Request()->pekerjaan_ayah,
                'pekerjaan_ibu' => Request()->pekerjaan_ibu
            ];

        }elseif ($id == "guru") {

            Request()->validate([
                'id_guru' => 'required|min:8|max:8',
                'nama_guru' => 'required',
                'no_telp' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'pendidikan' => 'required',
                'foto_guru' => 'mimes:jpg,jpeg|max:50'
            ], [
                'id_guru.required' => 'Tidak Boleh Kosong !!',
                'id_guru.min' => 'Min 8 Karakter',
                'id_guru.max' => 'Max 8 Karakter',
                'nama_guru.required' => 'Tidak Boleh Kosong !!',
                'no_telp.required' => 'Tidak Boleh Kosong !!',
                'tempat_lahir.required' => 'Tidak Boleh Kosong !!',
                'tanggal_lahir.required' => 'Tidak Boleh Kosong !!',
                'alamat.required' => 'Tidak Boleh Kosong !!',
                'pendidikan.required' => 'Tidak Boleh Kosong !!',
                'foto_guru.required' => 'Tidak Boleh Kosong !!',
                'foto_guru.max' => 'Maximal ukuran file 50 KB'
            ]);
    
            if (Request()->foto_guru <> ""){
                $file = Request()->foto_guru;
                $fileName = Request()->id_guru.'.jpg';
                $file->move(public_path('foto'), $fileName);
            }else{
                
            }
    
            $data = [
                'id_guru' => Request()->id_guru,
                'nama_guru' => Request()->nama_guru,
                'no_telp' => Request()->no_telp,
                'tempat_lahir' => Request()->tempat_lahir,
                'tanggal_lahir' => Request()->tanggal_lahir,
                'alamat' => Request()->alamat,
                'pendidikan' => Request()->pendidikan
            ];
        }                     

        $this->HomeModel->updateData($id, $id_update, $data);
        return redirect()->route($id)->with('toast_success', 'Data Berhasil Diupdate !');
    }

    public function delete($id, $id_delete)
    {
        if (is_file(public_path('foto').'/'.$id_delete.'.jpg')) {
            unlink(public_path('foto').'/'.$id_delete.'.jpg');
        } else {
        }        
        
        $this->HomeModel->deleteData($id, $id_delete);
        return redirect()->route($id)->with('success', 'Data Berhasil Dihapus !');
    }
    
}
