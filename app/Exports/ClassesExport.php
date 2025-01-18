<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ClassesExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $domaine;
    protected $rowCount = 1;
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

            $indent = str_repeat('    ', $level);

            if ($class->children->isNotEmpty()) {
                $this->parentRows[] = $this->rowCount;
            }

            // Aligné avec les champs de l'interface web et du PDF
            $data[] = [
                __('table_code') => $indent . $class->code,
                __('table_title') => $class->name,
                __('table_legal_duration') => $this->formatRules($class),
                __('table_references') => $this->formatReferences($class),
            ];

            if ($class->children->isNotEmpty()) {
                $this->processClasses($class->children, $data, $level + 1);
            }
        }
    }

    public function headings(): array
    {
        return [
            __('table_code'),
            __('table_title'),
            __('table_legal_duration'),
            __('table_references'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style de base pour le tableau
        $lastColumn = 'D'; // 4 colonnes maintenant
        $sheet->getStyle('A1:' . $lastColumn . $this->rowCount)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // En-tête
        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F8F9FA'],
            ],
        ]);

        // Classes parentes
        foreach ($this->parentRows as $row) {
            $sheet->getStyle('A' . $row . ':' . $lastColumn . $row)->applyFromArray([
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

        // Configuration des cellules
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        // Activer le retour à la ligne automatique
        $sheet->getStyle('A1:' . $lastColumn . $this->rowCount)
            ->getAlignment()
            ->setWrapText(true);

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

    private function formatRules($class)
    {
        if (!$class->rules || $class->rules->isEmpty()) {
            return '';
        }

        return $class->rules->map(function ($rule) {
            $parts = [];
            $parts[] = $rule->code;
            $parts[] = $rule->name;

            if ($rule->duration) {
                $parts[] = $rule->duration;
            }

            return implode(' - ', array_filter($parts));
        })->implode("\n");
    }

    private function formatReferences($class)
    {
        if (!$class->rules || $class->rules->isEmpty()) {
            return '';
        }

        return $class->rules->map(function ($rule) {
            if (!$rule->articles || $rule->articles->isEmpty()) {
                return '';
            }

            return $rule->articles->map(function ($article) {
                return $article->code . ' - ' . $article->name;
            })->implode("\n");
        })->filter()->implode("\n");
    }
}
