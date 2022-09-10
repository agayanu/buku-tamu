<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BukuTamuController extends Controller
{
    public function index()
    {
        $now = now()->format('Y-m-d');
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $now);
        $tgl = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];

        $data = DB::table('buku_tamu')->select('name','agency','created_at')->orderBy('created_at','desc')->limit(4)->get();

        return view('index',['tgl'=>$tgl,'data'=>$data]);
    }

    public function store(Request $r)
    {
        $rules = [
            'name'      => 'required|string',
            'gender'    => 'required|in:L,P',
            'hp'        => 'required|string|max:30',
            'agency'    => 'required|string',
            'necessary' => 'required|string',
        ];
    
        $messages = [
            'name.required'      => 'Nama wajib diisi',
            'name.string'        => 'Nama harus berupa string',
            'gender.required'    => 'Jenis Kelamin wajib diisi',
            'gender.in'          => 'Jenis Kelamin tidak sesuai',
            'hp.required'        => 'HP wajib diisi',
            'hp.string'          => 'HP harus berupa string',
            'hp.max'             => 'HP maksimal 30 karakter',
            'agency.required'    => 'Instansi wajib diisi',
            'agency.string'      => 'Instansi harus berupa string',
            'necessary.required' => 'Keperluan wajib diisi',
            'necessary.string'   => 'Keperluan harus berupa string',
        ];
  
        $validator = Validator::make($r->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with('error', 'Buku Tamu gagal di tambah: '.$validator->errors());
        }

        $name   = $r->input('name');
        $gender = $r->input('gender');
        $hp     = $r->input('hp');
        $agen   = $r->input('agency');
        $nec    = $r->input('necessary');

        DB::table('buku_tamu')
        ->insert([
            'name'       => $name,
            'gender'     => $gender,
            'hp'         => $hp,
            'agency'     => $agen,
            'necessary'  => $nec,
            'created_at' => now()
        ]);
        
        return redirect()->back()->with('success', 'Buku Tamu berhasil di tambah');
    }
}
