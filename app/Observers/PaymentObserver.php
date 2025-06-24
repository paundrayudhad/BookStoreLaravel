<?php

namespace App\Observers;

use App\Models\Payment;

class PaymentObserver
{
    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        // Check if status was changed to verified
        if ($payment->isDirty('status') && $payment->status === 'verified') {
            // Update the related transaction status to completed
            if ($payment->transaction) {
                $payment->transaction->update(['status' => 'completed']);
            }
        }
    }
}
