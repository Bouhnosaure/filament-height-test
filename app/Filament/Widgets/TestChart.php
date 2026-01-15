<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class TestChart extends ChartWidget
{
    public ?User $user = null;

    public ?string $period = null;

    protected ?string $heading = 'Statistiques globales';

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected ?string $height = '400px';

    protected ?string $maxHeight = '400px';

    protected function getData(): array
    {
        $currentYearData = json_decode('{"turnover":[558714,653028,443208,392458,597949,883467,293875,0,644163,703035,310290,605825],"margin":[17.68,11.33,12.25,20.98,17.63,18.26,14.14,0,0,11.71,24.83,20.85]}', true);

        $labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];

        return [
            'datasets' => [
                [
                    'label' => 'CA N (€)',
                    'data' => array_map(fn($val) => ($val), $currentYearData['turnover']),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderWidth' => 2,
                    'tension' => 0.4,
                    'fill' => false,
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'Marge % N',
                    'data' => $currentYearData['margin'],
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'borderWidth' => 2,
                    'tension' => 0.4,
                    'fill' => false,
                    'yAxisID' => 'y1',
                ]
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => 'CA (€)',
                        'font' => [
                            'size' => 13,
                            'weight' => 'bold',
                        ],
                    ],
                    'beginAtZero' => true,
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'title' => [
                        'display' => true,
                        'text' => 'Marge %',
                        'font' => [
                            'size' => 13,
                            'weight' => 'bold',
                        ],
                    ],
                    'beginAtZero' => true,
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 15,
                        'font' => [
                            'size' => 13,
                        ],
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                    'mode' => 'index',
                    'intersect' => false,
                ],
            ],
            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],
        ];
    }
}
