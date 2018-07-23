<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $fillable = [
        'name', 'parent_id', 'mobile', 'phone', 'national_number', 'nationality_id', 'email', 'sex',
        'dob', 'dob_hijri_day', 'dob_hijri_month', 'dob_hijri_year', 'marital_status_id', 'family_role_id',
        'family_member_count', 'son_count', 'daughter_count', 'expertise_id', 'social_status_id',
        'graduation_id', 'education_specialty_id', 'work_experience', 'profession_id', 'company_name', 'is_active',
        'is_banned', 'ban_reason', 'avatar', 'guardian_id', 'social_type_id', 'bank_id', 'resident_id', 'iban', 'notes'
    ];

    public function marital_status()
    {
        return $this->belongsTo('App\MaritalStatus');
    }
    public function social_status()
    {
        return $this->belongsTo('App\SocialStatus');
    }

    public function social_type()
    {
        return $this->belongsTo('App\SocialType');
    }

    public function nationality()
    {
        return $this->belongsTo('App\Nationality');
    }

    public function researches()
    {
        return $this->hasMany(Research::class);
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function resident()
    {
        return $this->belongsTo('App\Resident');
    }


    public function getDobHijriFormattedAttribute()
    {
        return str_pad($this->dob_hijri_day, 2, '0', STR_PAD_LEFT) . '/ ' . str_pad($this->dob_hijri_month, 2, '0', STR_PAD_LEFT) . '/ ' . $this->dob_hijri_year;
    }
}
