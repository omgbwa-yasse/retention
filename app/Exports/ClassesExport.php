<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClassesExport implements FromArray, WithHeadings, ShouldAutoSize
{
    protected $domaine;

    public function __construct($domaine)
    {
        $this->domaine = $domaine;
    }

    public function array(): array
    {
        $data = [];
        foreach ($this->domaine->childrenRecursive as $class) {
            $data[] = [
                'Cote' => $class->code,
                'Intitulé' => $class->name,
                'Typologies' => $this->getTypologies($class),
                'Active Délai' => $this->getActiveDuration($class),
                'Active Déclencheur' => $this->getActiveTrigger($class),
                'Semi-active Délai' => $this->getDuaDuration($class),
                'Semi-active Déclencheur' => $this->getDuaTrigger($class),
                'Durée légale Délai' => $this->getDulDuration($class),
                'Durée légale Déclencheur' => $this->getDulTrigger($class),
                'Références' => $this->getReferences($class),
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Cote',
            'Intitulé',
            'Typologies',
            'Active Délai',
            'Active Déclencheur',
            'Semi-active Délai',
            'Semi-active Déclencheur',
            'Durée légale Délai',
            'Durée légale Déclencheur',
            'Références',
        ];
    }

    private function getTypologies($class)
    {
        return $class->typologies ? implode(', ', $class->typologies->pluck('name')->toArray()) : '';
    }

    private function getActiveDuration($class)
    {
        return $class->rules ? implode(', ', $class->rules->map(function ($rule) {
            return $rule->actives ? implode(', ', $rule->actives->pluck('duration')->toArray()) : '';
        })->toArray()) : '';
    }

    private function getActiveTrigger($class)
    {
        return $class->rules ? implode(', ', $class->rules->map(function ($rule) {
            return $rule->actives ? implode(', ', $rule->actives->pluck('trigger.name')->toArray()) : '';
        })->toArray()) : '';
    }

    private function getDuaDuration($class)
    {
        return $class->rules ? implode(', ', $class->rules->map(function ($rule) {
            return $rule->duas ? implode(', ', $rule->duas->pluck('duration')->toArray()) : '';
        })->toArray()) : '';
    }

    private function getDuaTrigger($class)
    {
        return $class->rules ? implode(', ', $class->rules->map(function ($rule) {
            return $rule->duas ? implode(', ', $rule->duas->pluck('trigger.name')->toArray()) : '';
        })->toArray()) : '';
    }

    private function getDulDuration($class)
    {
        return $class->rules ? implode(', ', $class->rules->map(function ($rule) {
            return $rule->duls ? implode(', ', $rule->duls->pluck('duration')->toArray()) : '';
        })->toArray()) : '';
    }

    private function getDulTrigger($class)
    {
        return $class->rules ? implode(', ', $class->rules->map(function ($rule) {
            return $rule->duls ? implode(', ', $rule->duls->pluck('trigger.name')->toArray()) : '';
        })->toArray()) : '';
    }

    private function getReferences($class)
    {
        return $class->rules ? implode(', ', $class->rules->map(function ($rule) {
            return $rule->articles ? implode(', ', $rule->articles->pluck('name')->toArray()) : '';
        })->toArray()) : '';
    }
}
