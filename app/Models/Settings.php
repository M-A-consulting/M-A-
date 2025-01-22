<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    protected $fillable = [
        'company_name',
        'logo',
        'about',
        'founded_date',
        'email',
        'phone',
        'address',
        'social_links',
        'services_offered',
        'clients',
        'testimonials',
        'awards',
        'team_members',
        'founder',
        'certifications'
    ];
    protected $casts = [
        'social_links',
        'team_members'
    ];
}
