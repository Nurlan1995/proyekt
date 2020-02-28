<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BirthdayController extends Controller
{
    public function getBirthdayPeople()
    {
//     $result = DB::select(DB::raw("  SELECT emp_name,emp_surname,emp_father_name,emp_email,emp_birthday
//FROM m_employee
//WHERE emp_status = 'active' AND emp_email IS NOT NULL AND EXTRACT(MONTH
//FROM emp_birthday) = EXTRACT(MONTH
//FROM CURDATE()) AND EXTRACT(DAY
//FROM emp_birthday) = EXTRACT(DAY
//FROM CURDATE())  "));

        $result = DB::select(DB::raw("  SELECT *
FROM m_employee
WHERE emp_name in ('Nurlan95','Nurik95') "));

        if (count($result)) {
            return $result;
        } else {
            return 0;
        }

    }

    public function congratulate(Request $request)
    {
        $values = $request->all();
        $emails = json_decode($values["emails"], true);

        foreach ($emails as $email) {
            $data = array('name' => $email['emp_name']);
            Mail::send('birthdayMessage', $data, function ($message) {
                $message->to('nurlan.karimli@acsc.az', 'Nurlan')
                    ->subject('Test email')
                    ->from('nurlan.karimli@acsc.az', 'Nurlan');
            });
        }

        return 1;

    }

}
