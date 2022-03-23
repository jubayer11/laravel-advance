<?php

namespace App\Models;

use App\Exceptions\MinorCanNOtBuyAlcoholicBeverageException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bevarage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function buy()
    {
        if (auth()->user()->isMinor()) {
            throw  new MinorCanNOtBuyAlcoholicBeverageException;
        }
        return true;
    }
}
