<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Exception;
use App\Models\Siswa;
use App\Models\Orangtua;
use App\Models\Mahasiswa;
use App\Mail\TestSendEmail;
use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail as FacadesMail;

class EmailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Testing email from laravel',
            'body' => 'Ini testing body email bro'
        ];

        Mail::to('irgifahlevi5@gmail.com')->send(new TestSendEmail($mailData));

        dd('Send email sukses');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_siswa' => 'required|min:3',
            'nik' => 'required|min:10|max:10',
            'no_kk' => 'required|min:10|max:10',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required|max:500',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required|min:5|max:5',
            'email' => 'required|email',
            'tempat_tinggal' => 'required',
            'asal_sekolah' => 'required',
            'no_nisn' => 'required|max:11',
            'alamat_sekolah' => 'required',
            'kota_sekolah' => 'required',
            'gelombang_id' => 'required|exists:gelombangs,id'
        ];

        if (empty($request->nama_ayah) && empty($request->nama_ibu)) {
            $rules = array_merge($rules, [
                'nama_ayah' => 'required',
                'no_ktp_ayah' => 'required',
                'tempat_lahir_ayah' => 'required',
                'tanggal_lahir_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'pendidikan_terakhir_ayah' => 'required',
                'no_telepon_ayah' => 'required',
            ]);
        }

        if (!empty($request->nama_ayah)) {
            $rules = array_merge($rules, [
                'nama_ayah' => 'required',
                'no_ktp_ayah' => 'required',
                'tempat_lahir_ayah' => 'required',
                'tanggal_lahir_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'pendidikan_terakhir_ayah' => 'required',
                'no_telepon_ayah' => 'required',
            ]);
        } else if (
            empty($request->nama_ayah) && !empty($request->no_ktp_ayah)
            && !empty($request->tempat_lahir_ayah) && !empty($request->tanggal_lahir_ayah)
            && !empty($request->pekerjaan_ayah) && !empty($request->pendidikan_terakhir_ayah)
            && !empty($request->no_telepon_ayah)
        ) {
            // Jika nama_ayah kosong, semua bidang yang relevan harus diisi
            $rules = array_merge($rules, [
                'nama_ayah' => 'required',
            ]);
        } else if (
            !empty($request->nama_ayah) && empty($request->no_ktp_ayah)
            && !empty($request->tempat_lahir_ayah) && !empty($request->tanggal_lahir_ayah)
            && !empty($request->pekerjaan_ayah) && !empty($request->pendidikan_terakhir_ayah)
            && !empty($request->no_telepon_ayah)
        ) {
            $rules = array_merge($rules, [
                'no_ktp_ayah' => 'required',
            ]);
        } else if (
            !empty($request->nama_ayah) && !empty($request->no_ktp_ayah)
            && !empty($request->tempat_lahir_ayah) && empty($request->tanggal_lahir_ayah)
            && !empty($request->pekerjaan_ayah) && !empty($request->pendidikan_terakhir_ayah)
            && !empty($request->no_telepon_ayah)
        ) {
            $rules = array_merge($rules, [
                'tanggal_lahir_ayah' => 'required',
            ]);
        } else if (
            !empty($request->nama_ayah) && !empty($request->no_ktp_ayah)
            && empty($request->tempat_lahir_ayah) && !empty($request->tanggal_lahir_ayah)
            && !empty($request->pekerjaan_ayah) && !empty($request->pendidikan_terakhir_ayah)
            && !empty($request->no_telepon_ayah)
        ) {
            $rules = array_merge($rules, [
                'tempat_lahir_ayah' => 'required',
            ]);
        } else {
            // $rules = array_merge($rules, [
            //     'nama_ayah' => 'nullable|min:3',
            //     'no_ktp_ayah' => 'nullable',
            //     'tempat_lahir_ayah' => 'nullable',
            //     'tanggal_lahir_ayah' => 'nullable',
            //     'pekerjaan_ayah' => 'nullable',
            //     'pendidikan_terakhir_ayah' => 'nullable',
            //     'no_telepon_ayah' => 'nullable',
            // ]);
        }

        // Data ibu
        if (!empty($request->nama_ibu)) {
            $rules = array_merge($rules, [
                'nama_ibu' => 'required',
                'no_ktp_ibu' => 'required',
                'tempat_lahir_ibu' => 'required',
                'tanggal_lahir_ibu' => 'required',
                'pekerjaan_ibu' => 'required',
                'pendidikan_terakhir_ibu' => 'required',
                'no_telepon_ibu' => 'required',
            ]);
        } else if (
            empty($request->nama_ibu) && !empty($request->no_ktp_ibu)
            && !empty($request->tempat_lahir_ibu) && !empty($request->tanggal_lahir_ibu)
            && !empty($request->pekerjaan_ibu) && !empty($request->pendidikan_terakhir_ibu)
            && !empty($request->no_telepon_ibu)
        ) {
            // Jika nama_ibu kosong, semua bidang yang relevan harus diisi
            $rules = array_merge($rules, [
                'nama_ibu' => 'required',
            ]);
        } else if (
            !empty($request->nama_ibu) && empty($request->no_ktp_ibu)
            && !empty($request->tempat_lahir_ibu) && !empty($request->tanggal_lahir_ibu)
            && !empty($request->pekerjaan_ibu) && !empty($request->pendidikan_terakhir_ibu)
            && !empty($request->no_telepon_ibu)
        ) {
            $rules = array_merge($rules, [
                'no_ktp_ibu' => 'required',
            ]);
        } else if (
            !empty($request->nama_ibu) && !empty($request->no_ktp_ibu)
            && !empty($request->tempat_lahir_ibu) && empty($request->tanggal_lahir_ibu)
            && !empty($request->pekerjaan_ibu) && !empty($request->pendidikan_terakhir_ibu)
            && !empty($request->no_telepon_ibu)
        ) {
            $rules = array_merge($rules, [
                'tanggal_lahir_ibu' => 'required',
            ]);
        } else if (
            !empty($request->nama_ibu) && !empty($request->no_ktp_ibu)
            && empty($request->tempat_lahir_ibu) && !empty($request->tanggal_lahir_ibu)
            && !empty($request->pekerjaan_ibu) && !empty($request->pendidikan_terakhir_ibu)
            && !empty($request->no_telepon_ibu)
        ) {
            $rules = array_merge($rules, [
                'tempat_lahir_ibu' => 'required',
            ]);
        } else {
            // $rules = array_merge($rules, [
            //     'nama_ibu' => 'nullable|min:3',
            //     'no_ktp_ibu' => 'nullable',
            //     'tempat_lahir_ibu' => 'nullable',
            //     'tanggal_lahir_ibu' => 'nullable',
            //     'pekerjaan_ibu' => 'nullable',
            //     'pendidikan_terakhir_ibu' => 'nullable',
            //     'no_telepon_ibu' => 'nullable',
            // ]);
        }



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ], 400);
        }

        try {
            DB::transaction(function () use ($request) {
                $calon_siswa = new Siswa();

                $calon_siswa->nama_siswa = $request->nama_siswa;
                $calon_siswa->nik = $request->nik;
                $calon_siswa->no_kk = $request->no_kk;
                $calon_siswa->jenis_kelamin = $request->jenis_kelamin;
                $calon_siswa->tempat_lahir = $request->tempat_lahir;
                $calon_siswa->tanggal_lahir = $request->tanggal_lahir;
                $calon_siswa->agama = $request->agama;
                $calon_siswa->alamat = $request->alamat;
                $calon_siswa->kelurahan = $request->kelurahan;
                $calon_siswa->kecamatan = $request->kecamatan;
                $calon_siswa->kota = $request->kota;
                $calon_siswa->kode_pos = $request->kode_pos;
                $calon_siswa->email = $request->email;
                $calon_siswa->tempat_tinggal = $request->tempat_tinggal;
                $calon_siswa->asal_sekolah = $request->asal_sekolah;
                $calon_siswa->no_nisn = $request->no_nisn;
                $calon_siswa->alamat_sekolah = $request->alamat_sekolah;
                $calon_siswa->kota_sekolah = $request->kota_sekolah;
                $calon_siswa->row_status = 0;
                $calon_siswa->save();

                $orangtua_siswa = new Orangtua();
                $orangtua_siswa->nama_ayah = $request->nama_ayah;
                $orangtua_siswa->no_ktp_ayah = $request->no_ktp_ayah;
                $orangtua_siswa->tempat_lahir_ayah = $request->tempat_lahir_ayah;
                $orangtua_siswa->tanggal_lahir_ayah = $request->tanggal_lahir_ayah;
                $orangtua_siswa->pekerjaan_ayah = $request->pekerjaan_ayah;
                $orangtua_siswa->pendidikan_terakhir_ayah = $request->pendidikan_terakhir_ayah;
                $orangtua_siswa->no_telepon_ayah = $request->no_telepon_ayah;
                $orangtua_siswa->nama_ibu = $request->nama_ibu;
                $orangtua_siswa->no_ktp_ibu = $request->no_ktp_ibu;
                $orangtua_siswa->tempat_lahir_ibu = $request->tempat_lahir_ibu;
                $orangtua_siswa->tanggal_lahir_ibu = $request->tanggal_lahir_ibu;
                $orangtua_siswa->pekerjaan_ibu = $request->pekerjaan_ibu;
                $orangtua_siswa->pendidikan_terakhir_ibu = $request->pendidikan_terakhir_ibu;
                $orangtua_siswa->no_telepon_ibu = $request->no_telepon_ibu;
                $orangtua_siswa->row_status = 0;
                $orangtua_siswa->save();


                $pendaftaran = new Pendaftaran();
                $length = 15;
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $no_pendaftaran = strtoupper(Str::random($length, $characters));
                $siswa_id = $calon_siswa->id;
                $orangtua_id = $orangtua_siswa->id;

                $pendaftaran->no_pendaftaran = $no_pendaftaran;
                $pendaftaran->siswa_id = $siswa_id;
                $pendaftaran->orangtua_id = $orangtua_id;
                $pendaftaran->gelombang_id = $request->gelombang_id;
                $pendaftaran->is_bayar = 0;
                $pendaftaran->row_status = 0;
                $pendaftaran->save();


                $mailData = [
                    'title' => 'Yeay, Pendaftaran Berhasil!',
                    'body' => $pendaftaran->no_pendaftaran
                ];

                Mail::to($request->email)->send(new TestSendEmail($mailData));
            });

            $kode_regis = Pendaftaran::all()->or

            return response()->json([
                'status' => 200,
                'message' => 'Record successfully saved!'
            ], 201);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred: ' . $ex->getMessage()
            ], 500);
        }

        // try {
        //     $mhs = new Mahasiswa();
        //     $mhs->nama = $request->nama;
        //     $mhs->email = $request->email;
        //     $mhs->kelas = $request->kelas;
        //     $mhs->save();

        //     // $mailData = [
        //     //     'title' => 'Yeay, Pendaftaran Berhasil!',
        //     //     'body' => $request->kelas
        //     // ];

        //     // Mail::to($request->email)->send(new TestSendEmail($mailData));

        //     return response()->json([
        //         'status' => 200,
        //         'message' => 'Record successfully saved!'
        //     ], 201);
        // } catch (Exception $ex) {
        //     return response()->json([
        //         'status' => 500,
        //         'message' => 'An error occurred: ' . $ex->getMessage()
        //     ], 500);
        // }
    }
}
