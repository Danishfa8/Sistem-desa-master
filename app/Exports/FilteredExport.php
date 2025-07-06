<?php

namespace App\Exports;

use App\Http\Controllers\DataAngkaController;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FilteredExport implements FromView
{
    protected $request;
    protected $categoryName;

    public function __construct($request, $categoryName)
    {
        $this->request = $request;
        $this->categoryName = $categoryName;
    }

    public function view(): View
    {
        $controller = new DataAngkaController;
        $data = $controller->getFilteredData($this->request);

        return view('exports.filtered_excel', [
            'data' => $data,
            'categoryName' => $this->categoryName
        ]);
    }
}


