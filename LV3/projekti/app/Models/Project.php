<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','price','jobs','start_date','end_date','members'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
    ];

    /**
     * Get the user that owns the project.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
