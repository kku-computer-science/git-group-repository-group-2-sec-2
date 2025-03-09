<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'program_name_th','program_name_en','program_name_zh','degree_id','department_id','program_code','program_type','program_status','program_start_date','program_end_date','program_description','program_image','program_url','program_contact','program_email','program_tel','program_fax','program_facebook','program_line','program_twitter','program_instagram','program_youtube','program_created_by','program_updated_by','program_deleted_by','program_created_at','program_updated_at','program_deleted_at',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
        
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function department()
    {
        return $this->belongsTo(department::class);
    }
}
