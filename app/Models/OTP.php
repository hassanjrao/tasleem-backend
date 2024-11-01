<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OTP extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    protected $table='otps';

    public function generateOTP(String $country_code, String $phone) : OTP
    {

        $country_code = str_replace("+", "", $country_code);
        // generate OTP
        $otp_number = random_int(1000, 9999);

        // store OTP in database
        $otp = new OTP();
        $otp->otp = $otp_number;

        $otp->phone = $phone;
        $otp->country_code = $country_code;
        $otp->expires_at = now()->addMinutes(5);

        $otp->save();

        return $otp;
    }
}
