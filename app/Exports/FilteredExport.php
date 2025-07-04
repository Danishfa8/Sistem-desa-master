<?php

namespace App\Exports;

use App\Http\Controllers\DataAngkaController;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FilteredExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $controller = new DataAngkaController;
        $data = $controller->getFilteredData($this->request);

        return view('exports.filtered_excel', [
            'data' => $data
        ]);
    }
}

