<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
  protected $fillable = [
      'login_id', 'name', 'text'
  ];

  protected $guarded = [
      'create_at', 'update_at'
  ];
}
