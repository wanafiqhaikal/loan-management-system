<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $primaryKey = 'loan_id';
    protected $fillable = ['name', 'type', 'amount', 'duration', 'installment'];

    public function documents()
    {
        return $this->hasMany(Document::class, 'loan_id');
    }
}
