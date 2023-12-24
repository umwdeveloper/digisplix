<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model {
    use HasFactory;

    protected $fillable = [
        'description',
        'price',
        'quantity'
    ];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function getTotalPriceAttribute() {
        return $this->price * $this->quantity;
    }
}
