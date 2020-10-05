<?php

namespace App\Exports;

use App\FeaturAd;
use Maatwebsite\Excel\Concerns\FromCollection;

class PromoteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FeaturAd::all();
    }
}
