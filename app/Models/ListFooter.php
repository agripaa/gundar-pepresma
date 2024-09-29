<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListFooter extends Model
{
    use HasFactory;

    protected $table = 'list_footer';

    protected $fillable = ['name_list', 'link', 'footer_id'];

    public function footer()
    {
        return $this->belongsTo(Footer::class);
    }
}
