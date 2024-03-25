<?php


namespace App\Exports;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromCollection, WithHeadings, WithEvents, WithStyles
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function collection()
    {
//        $orderData = [
//            ['ID' => $this->order->id,
//                'Статус' => $this->order->status,
//                'Вес заказа' => $this->order->total_weight,
//                'Сумма' => $this->order->total_amount],
//        ];

        $itemsData = $this->order->items->map(function ($item, $key) {
            return [
                'ID' => $item->id,
                'Наименование' => $item->name,
                'Цена' => $item->price,
                'Количество' => $item->quantity,
                'Сумма' => $item->total_price,
            ];
        });

        return collect($itemsData);
    }

    public function headings(): array
    {
        return [
//            ['Номер заказа', 'Статус', 'Вес', 'Сумма'],
            ['Номер позиции', 'Наименование', 'Цена', 'Количество', 'Сумма позиции'],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFFFFF00'],
                    ],
                ]);

                $itemStartRow = 2;
                $itemEndRow = $itemStartRow + $this->order->items->count() - 1;

                $event->sheet->getStyle("A{$itemStartRow}:E{$itemEndRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFFFFF00'],
                    ],
                ]);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Стили для заголовков
            1    => ['font' => ['bold' => true]],
            2    => ['font' => ['bold' => true]],
        ];
    }
}


