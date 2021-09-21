<?php

namespace App\Http\Controllers;

use App\Mail\EmailOneTimePassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OTP;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function isEmailExist($email)
    {
        $otpNumber = $this->generateOTP();
        $recordUsers = User::where('email', $email)->get();
        if (count($recordUsers) > 0) {
            $this->saveNewOTP($recordUsers[0]['email'], $otpNumber);
        }
        return response()->json($recordUsers);
    }

    public function isOTPExist($email, $otp)
    {
        $recordOTPs = OTP::where('otp', $otp)->where('email', $email)->where('status', 'active')->get();
        if (count($recordOTPs) > 0) {
            $this->updateOTPStatusFromActiveToExpired($otp);
        }
        return response()->json($recordOTPs);
    }

    public function saveNewOTP($email, $otpNumber)
    {
        OTP::create([
            'email' => $email,
            'otp' => $otpNumber,
            'status' => 'active'
        ]);
        $this->sendEmails($email, $otpNumber);
    }

    public function generateOTP()
    {
        return mt_rand(0, 10000);
    }

    public function sendEmails($email, $otpCode)
    {
        $data = [
            'otpCode' => $otpCode,
            'email' => $email,
        ];
        Mail::to($email)->send(new EmailOneTimePassword($data));
    }

    public function updateOTPStatusFromActiveToExpired($otpCode)
    {
        OTP::where('otp', '=', $otpCode)->update(array('status' => 'expired'));
    }
}
