<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $primaryKey = 'document_id';
    protected $fillable = ['loan_id', 'file_name', 'extension', 'content'];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }
}
