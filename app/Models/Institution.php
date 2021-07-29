<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use App\Models\Major;
use App\Models\Faculty;
class Institution extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_sekolah','nama','tipe','email','alamat','kab_kota','provinsi','no_telp'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    protected $appends = ['major_data','faculty_data'];

    protected $primaryKey = 'kode_sekolah';
    public function getMajorDataAttribute(){
        return Major::where('id_institusi',$this->kode_sekolah)->get();
    }
    public function getFacultyDataAttribute(){
        return Faculty::where('id_institusi',$this->kode_sekolah)->get();
    }
}
