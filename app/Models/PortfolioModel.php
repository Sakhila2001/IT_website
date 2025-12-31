<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class PortfolioModel extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $fillable = ['title', 'portfolio_category_id',  'is_publish', 'image', 'is_delete'];
    public function portfoliocategories()
    {
        return $this->belongsTo(PortfolioCategoryModel::class, 'portfolio_category_id');
    }
}
