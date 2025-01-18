<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class ClassesExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $domaine;
    protected $rowCount = 1; // Commencer après la ligne d'en-tête
    protected $parentRows = [];

    public function __construct($domaine)
    {
        $this->domaine = $domaine;
    }

    public function array(): array
    {
        $data = [];
        $this->processClasses($this->domaine->children, $data);
        return $data;
    }

    private function processClasses($classes, &$data, $level = 0)
    {
        foreach ($classes as $class) {
            $this->rowCount++;

            // Ajouter des espaces pour l'indentation visuelle
            $indent = str_repeat('    ', $level);

            // Stocker la ligne si c'est une classe parente
            if ($class->children->isNotEmpty()) {
                $this->parentRows[] = $this->rowCount;
            }

            $data[] = [
                'Cote' => $indent . $class->code,
                'Intitulé' => $class->name,
                'Typologies' => $this->getTypologies($class),
                'Durée légale Délai' => $this->getDulDuration($class),
                'Durée légale Déclencheur' => $this->getDulTrigger($class),
                'Références' => $this->getReferences($class),
                '_level' => $level, // Pour le style conditionnel
            ];

            // Traiter récursivement les sous-classes
            if ($class->children->isNotEmpty()) {
                $this->processClasses($class->children, $data, $level + 1);
            }
        }
    }

    public function headings(): array
    {
        return [
            'Cote',
            'Intitulé',
            'Typologies',
            'Durée légale Délai',
            'Durée légale Déclencheur',
            'Références',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style de base pour tout le tableau
        $sheet->getStyle('A1:F' . $this->rowCount)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Style pour l'en-tête
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F8F9FA'],
            ],
        ]);

        // Style pour les classes parentes
        foreach ($this->parentRows as $row) {
            $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => '3498DB'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8F9FA'],
                ],
            ]);
        }

        // Ajuster la hauteur des lignes pour une meilleure lisibilité
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8F9FA'],
                ],
            ],
        ];
    }

    private function getTypologies($class)
    {
        return $class->typologies ? implode("\n", $class->typologies->pluck('name')->toArray()) : '';
    }

    private function getDulDuration($class)
    {
        if (!$class->rules) return '';

        return $class->rules->map(function ($rule) {
            if (!$rule->duls) return '';
            $durations = $rule->duls->pluck('duration')->filter()->toArray();
            return $rule->code . ': ' . implode(', ', $durations);
        })->filter()->implode("\n");
    }

    private function getDulTrigger($class)
    {
        if (!$class->rules) return '';

        return $class->rules->map(function ($rule) {
            if (!$rule->duls) return '';
            $triggers = $rule->duls->map(function ($dul) {
                return $dul->trigger ? $dul->trigger->name : '';
            })->filter()->toArray();
            return $rule->code . ': ' . implode(', ', $triggers);
        })->filter()->implode("\n");
    }

    private function getReferences($class)
    {
        if (!$class->rules) return '';

        return $class->rules->map(function ($rule) {
            if (!$rule->articles) return '';
            $articles = $rule->articles->map(function ($article) {
                return $article->code . ' - ' . $article->name;
            })->toArray();
            return implode("\n", $articles);
        })->filter()->implode("\n");
    }
}
