<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Book;
use App\Models\TransactionDetail;
use Filament\Resources\Pages\EditRecord;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $originalStatus = $this->record->status;

        // Jika status berubah dari bukan 'cancelled' menjadi 'cancelled'
        if ($originalStatus !== 'cancelled' && $data['status'] === 'cancelled') {
            foreach ($this->record->details as $detail) {
                $book = $detail->book;
                $book->stock += $detail->quantity;
                $book->save();
            }
        }

        return $data;
    }
}
