<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'portfolio_categories';

    protected $fillable = ['name', 'is_publish', 'is_delete'];

    public function portfolios()
    {
        return $this->hasMany(PortfolioModel::class, 'portfolio_category_id');
    }
}
