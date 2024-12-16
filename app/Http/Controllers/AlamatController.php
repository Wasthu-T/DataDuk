<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_provinsi()
    {
        $filePath = resource_path('data/provinsi.csv'); // Path file CSV
        $file = fopen($filePath, 'r');
    
        $header = null; // Simpan header CSV
        $data = [];     // Simpan data hasil parsing
    
        while (($row = fgetcsv($file, 1000, ';')) !== false) {
            if (!$header) {
                $header = $row; // Baris pertama sebagai header
            } else {
                $data[] = array_combine($header, $row); // Gabungkan header dengan data
            }
        }
    
        fclose($file);
        return response()->json($data);
    }

    public function get_kabupaten($id)
    {
        $filePath = resource_path('data/kabupaten.csv'); // Path file CSV
        $file = fopen($filePath, 'r');
    
        $header = null; // Simpan header CSV
        $data = [];     // Simpan data hasil parsing
    
        while (($row = fgetcsv($file, 1000, ';')) !== false) {
            if (!$header) {
                $header = $row; // Baris pertama sebagai header
            } else {
                $rowData = array_combine($header, $row);
                if (trim($rowData['kode_provinsi']) == $id) {
                    $data[] = $rowData;
                }
            }
        }
    
        fclose($file);

        if (!empty($data)){
            return response()->json($data);
        }
        return response()->json(['message'=>"Data Tidak ditemukan"],400);
    }
    public function get_kecamatan($id)
    {
        $filePath = resource_path('data/kecamatan.csv'); // Path file CSV
        $file = fopen($filePath, 'r');
    
        $header = null; // Simpan header CSV
        $data = [];     // Simpan data hasil parsing
    
        while (($row = fgetcsv($file, 10000, ';')) !== false) {
            if (!$header) {
                $header = $row; // Baris pertama sebagai header
            } else {
                $rowData = array_combine($header, $row);
                if (trim($rowData['kode_kabupaten']) == $id) {
                    $data[] = $rowData;
                }
            }
        }
    
        fclose($file);
    
        if (!empty($data)){
            return response()->json($data);
        }
        return response()->json(['message'=>"Data Tidak ditemukan"],400);
    }

    public function get_desa($id)
    {
        $filePath = resource_path('data/desa.csv'); // Path file CSV
        $file = fopen($filePath, 'r');
    
        $header = null; // Simpan header CSV
        $data = [];     // Simpan data hasil parsing
    
        while (($row = fgetcsv($file, 90000, ';')) !== false) {
            if (!$header) {
                $header = $row; // Baris pertama sebagai header
            } else {
                $rowData = array_combine($header, $row);
                if (trim($rowData['kode_kecamatan']) == $id) {
                    $data[] = $rowData;
                }
            }
        }
    
        fclose($file);
    
        if (!empty($data)){
            return response()->json($data);
        }
        return response()->json(['message'=>"Data Tidak ditemukan"],400);
    }

    public function get_kodepos($id)
    {
        $filePath = resource_path('data/kodepos.csv'); // Path file CSV
        $file = fopen($filePath, 'r');
    
        $header = null; // Simpan header CSV
        $data = [];     // Simpan data hasil parsing
    
        while (($row = fgetcsv($file, 90000, ';')) !== false) {
            if (!$header) {
                $header = $row; // Baris pertama sebagai header
            } else {
                $rowData = array_combine($header, $row);
                if (trim($rowData['kode_desa']) == $id) {
                    $data[] = $rowData;
                }
            }
        }
    
        fclose($file);
    
        if (!empty($data)){
            return response()->json($data);
        }
        return response()->json(['message'=>"Data Tidak ditemukan"],400);
    }

}
