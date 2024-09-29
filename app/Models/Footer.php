<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footer';

    protected $fillable = ['title_footer'];

    public function listFooters()
    {
        return $this->hasMany(ListFooter::class);
    }
}
