<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $to_name = 'taloes';
        $to_email = 'talisa.vandevelde@re-trace.io';

        $data = array('name'=>"Ogbonna Vitalis(sender_name)", "body" => "A test mail");


Mail::send('emails.mail', $data, function ($message) use ($to_name, $to_email) {
    $message->to($to_email, $to_name)->subject('Laravel Test Mail');
$message->from('4b80dcb6d68f2f', 'Test Mail');
});
    }
}
