<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\JenisSurat;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        User::updateOrCreate(
            ['email' => 'admin@desa-pagendisan.com'],
            [
                'name'      => 'Admin Desa Pagendisan',
                'email'     => 'admin@desa-pagendisan.com',
                'password'  => Hash::make('password'),
                'role'      => 'admin',
                'nik'       => '3318010101800001',
                'no_hp'     => '082100000001',
                'is_active' => true,
            ]
        );

        // Masyarakat account
        User::updateOrCreate(
            ['email' => 'user@desa-pagendisan.com'],
            [
                'name'      => 'Budi Santoso',
                'email'     => 'user@desa-pagendisan.com',
                'password'  => Hash::make('password'),
                'role'      => 'masyarakat',
                'nik'       => '3318010101900002',
                'no_hp'     => '082100000002',
                'is_active' => true,
            ]
        );

        // Jenis Surat
        $jenisSuratData = [
            ['nama'=>'Surat Keterangan Domisili','kode'=>'SKD','deskripsi'=>'Surat keterangan tempat tinggal','persyaratan'=>"- Fotokopi KTP\n- Fotokopi KK\n- Surat pengantar RT/RW",'is_active'=>true],
            ['nama'=>'Surat Keterangan Usaha','kode'=>'SKU','deskripsi'=>'Surat keterangan untuk UMKM','persyaratan'=>"- Fotokopi KTP\n- Fotokopi KK\n- Surat pengantar RT/RW\n- Foto tempat usaha",'is_active'=>true],
            ['nama'=>'Surat Keterangan Tidak Mampu','kode'=>'SKTM','deskripsi'=>'Surat keterangan kurang mampu','persyaratan'=>"- Fotokopi KTP\n- Fotokopi KK\n- Surat pengantar RT/RW",'is_active'=>true],
            ['nama'=>'Surat Pengantar Nikah','kode'=>'SPN','deskripsi'=>'Surat pengantar pernikahan ke KUA','persyaratan'=>"- Fotokopi KTP\n- Fotokopi KK\n- Akta kelahiran\n- Pas foto",'is_active'=>true],
            ['nama'=>'Surat Keterangan Kelahiran','kode'=>'SKL','deskripsi'=>'Surat keterangan kelahiran anak','persyaratan'=>"- Surat dari bidan/RS\n- Fotokopi KTP orang tua\n- Fotokopi KK",'is_active'=>true],
            ['nama'=>'Surat Keterangan Kematian','kode'=>'SKM','deskripsi'=>'Surat keterangan kematian penduduk','persyaratan'=>"- Surat dari dokter/puskesmas\n- Fotokopi KTP almarhum\n- Fotokopi KK",'is_active'=>true],
            ['nama'=>'Surat Keterangan Pindah','kode'=>'SKP','deskripsi'=>'Surat keterangan pindah domisili','persyaratan'=>"- Fotokopi KTP\n- Fotokopi KK\n- Surat pengantar RT/RW",'is_active'=>true],
            ['nama'=>'Surat Keterangan Belum Menikah','kode'=>'SKBM','deskripsi'=>'Surat belum pernah menikah','persyaratan'=>"- Fotokopi KTP\n- Fotokopi KK\n- Akta kelahiran",'is_active'=>true],
        ];

        foreach ($jenisSuratData as $data) {
            JenisSurat::updateOrCreate(['kode' => $data['kode']], $data);
        }

    }
}
