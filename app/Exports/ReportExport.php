<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithMapping, WithHeadings
{
    protected $provinces;
    protected $regencies;
    protected $subdistricts;
    protected $villages;
    protected $rowNumber;
    protected $date;

    public function __construct($provinces, $regencies, $subdistricts, $villages, $date = null)
    {
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->subdistricts = $subdistricts;
        $this->villages = $villages;
        $this->rowNumber = 0;
        $this->date = $date;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Report::with('response', 'user');
        if ($this->date) {
            $query->whereDate('created_at', $this->date);
        }
        return $query->get();
    }

    public function map($report): array
    {
        $this->rowNumber++;

        $province = collect($this->provinces)->where('id', $report->province)->first();
        $regency = collect($this->regencies)->where('id', $report->regency)->first();
        $subdistrict = collect($this->subdistricts)->where('id', $report->subdistrict)->first();
        $village = collect($this->villages)->where('id', $report->village)->first();

        $responseStatus = 'Belum Ditanggapi';
        $responseProgres = '';
        $staffEmail = '';

        foreach ($report->response as $response) {
            if ($response->response_status) {
                $responseStatus = $response->response_status;
            }

            foreach ($response->responseProgres as $progres) {
                $histories = $progres->histories;
                $responseProgres = $histories['tanggapan'];
            }
            
            $staffEmail = $response->staff_id ? \App\Models\User::find($response->staff_id)->email : 'Belum Ditanggapi';
        }

        return [
            $this->rowNumber,
            $report->user->email,
            \Carbon\Carbon::parse($report->created_at)->locale('id')->isoFormat('D MMMM YYYY'),
            $report->description,
            url('assets/images/' . $report->image),
            implode(', ', [$village['name'], $subdistrict['name'], $regency['name'], $province['name']]),
            $report->votes ? $report->votes->count() : "0",
            $responseStatus,
            $responseProgres,
            $staffEmail,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Email Pelapor',
            'Dilaporkan pada Tanggal',
            'Deskripsi Pengaduan',
            'URL Gambar',
            'Lokasi',
            'Jumlah Voting',
            'Status Pengaduan',
            'Progres Tanggapan',
            'Staff Terkait',
        ];
    }
}