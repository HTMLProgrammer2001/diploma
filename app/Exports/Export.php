<?php

namespace App\Exports;

use App\Repositories\Interfaces\EducationRepositoryInterface;
use App\Repositories\Interfaces\HonorRepositoryInterface;
use App\Repositories\Interfaces\InternshipRepositoryInterface;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use App\Repositories\Interfaces\RebukeRepositoryInterface;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class Export implements FromCollection, WithHeadings, WithEvents
{
    private $educationRep, $qualificationRep, $internshipRep, $honorRep, $rebukeRep;
    public function __construct()
    {
        $this->educationRep = app(EducationRepositoryInterface::class);
        $this->qualificationRep = app(QualificationRepositoryInterface::class);
        $this->internshipRep = app(InternshipRepositoryInterface::class);
        $this->honorRep = app(HonorRepositoryInterface::class);
        $this->rebukeRep = app(RebukeRepositoryInterface::class);
    }

    public function headings(): array
    {
        return ['ФІО', 'Дата народження', 'Освіта', 'Рік прийому на роботу', 'Вислуга', 'Особисті дані',
                    'Посада', 'Категорія, рік встановлення', 'Педагогічне звання',
                    'Вчене звання, рік встановлення', 'Науковий ступінь, рік встановлення', 'Стажування',
                    'Нагороди', 'Догани'];
    }

    public function collection()
    {
        //parse data
        $result = User::all()->map(function($item){
            return [
                $item->getFullName(),
                to_locale_date($item->birthday),
                $this->educationRep->getUserString($item->id),
                $item->hiring_year,
                $item->experience,
                $item->email . ', ' . $item->phone . ', ' . $item->address,
                $item->getRankName(),
                $this->qualificationRep->getQualificationNameOf($item->id) . ', ' .
                    to_locale_date($this->qualificationRep->getLastQualificationDateOf($item->id)),
                $item->pedagogical_title,
                $item->scientific_degree . ', ' . $item->scientific_degree_year,
                $item->academic_status . ', ' . $item->academic_status_year,
                $this->internshipRep->getUserString($item->id),
                $this->honorRep->getUserString($item->id),
                $this->rebukeRep->getUserString($item->id)
            ];
        });

        //add empty row
        $result->prepend(['']);

        return $result;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
                $sheet = $event->sheet;

                //set auto size
                foreach (range('A', 'Z') as $col)
                    $sheet->getColumnDimension($col)->setAutoSize(true);
            }
        ];
    }
}
