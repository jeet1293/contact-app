<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContactExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contact::with('tags')->get();
    }

    public function map($contact): array
    {
        $tags = [];
        foreach ($contact->tags as $tag) {
            $tags [] = $tag->tag ; 
        }
        return [
            $contact->id,
            $contact->name,
            $contact->phone,
            implode(',', $tags),
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Phone',
            'Tags',
        ];
    }
}
