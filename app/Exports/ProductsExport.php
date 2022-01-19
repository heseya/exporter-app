<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        protected $products,
        protected $store_front_url,
    ) {
    }

    public function collection(): Collection
    {
        return $this->products;
    }

    public function headings(): array
    {
        return [
            'id',
            'title',
            'description',
            'availability',
            'condition',
            'price',
            'link',
            'image_link',
            'brand',
        ];
    }

    public function map($row): array
    {
        return [
            $row['id'],
            $row['name'],
            $row['description_short'],
            $row['available'] ? 'in stock' : 'out of stock',
            'new',
            "{$row['price']} {$row['currency']}",
            "{$this->store_front_url}products/{$row['slug']}",
            $row['cover'] ? $row['cover']['url'] : '',
            'Brak',
        ];
    }
}