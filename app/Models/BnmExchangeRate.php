<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BnmExchangeRate extends Model
{
    use HasFactory;

    protected $fillable = ['eur', 'usd', 'ron', 'rub'];

    public const EUR_NUM_CODE = '978';
    public const USD_NUM_CODE = '840';
    public const RON_NUM_CODE = '946';

    public const CURRENCIES = ['MDL', 'USD', 'EUR', 'RON'];

    public function getMdlAttribute(): int
    {
        return 1;
    }
}
