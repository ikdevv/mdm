<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;

class ItemsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Item::select(
            'brand_id',
            'category_id',
            'code',
            'name',
            'status',
        )->get();
    }

    /**
     * Return the column headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Brand ID',
            'Category ID',
            'Code',
            'Name',
            'Status',
        ];
    }




}
