<?php

namespace App\Http\Controllers;

use App\Exports\TrainerExport;
use App\Imports\TrainerImport;
use App\Models\customer;
use App\Models\trainer;
use Dotenv\Parser\Value;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;

class TrainerController extends Controller
{

    public function export_trainer($value){
        if($value=='trainer_xlsx'){
            return Excel::download(new TrainerExport, 'trainer_list.xlsx');
            return redirect('manage-trainer');
        }
        elseif($value=='trainer_csv'){
            return Excel::download(new TrainerExport, 'trainer_list.csv');
            return redirect('manage-trainer');
        }
        else{
            return 'Error';
        }
    }

    public function import_trainer(Request $req){

        // dd($req->file('file_trainer'));
        Excel::import(new TrainerImport, $req->file('file_trainer'));
        return redirect('manage-trainer');
    }


    //Move to Page
    public function create_data()
    {
        $page_title = 'Add Trainer';
        $page_description = 'Some description for the page';
        $action = __FUNCTION__;

        return view('trainer.createnew', compact('page_title', 'page_description', 'action'));
    }
    public function create_new_trainer(Request $req)
    {
        $db = new trainer();
        $db->first_name = $req->firstName;
        $db->last_name = $req->lastName;
        $db->email = $req->email;
        $db->phone_number = $req->phoneNumber;
        $db->address = $req->place;
        $db->date_of_birth = $req->dob;
        $db->date_of_joining = $req->doj;
        $db->cnic = $req->cnic;
        $db->fixed_salary = $req->fixed_salary;
        $db->commision = $req->commision;
        $db->timing_in = $req->tin;
        $db->timing_out = $req->tout;
        // Image Section
        if ($req->file('tfile')) {
            $image_original = $req->file('tfile');
            $extension = $image_original->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $image_original->move('upload/trainers_images/', $fileName);
            $db->image = $fileName;
        }
        if ($db->save()) {
            return redirect('manage-trainer');
        }
    }
    // Show Table 
    public function trainer_manage()
    {
        $page_title = 'Manage Trainers';
        $page_description = 'Some description for the page';
        $action = __FUNCTION__;
        return view('trainer.manage', compact('page_title', 'page_description', 'action'));
    }

    public function manage_data(Request $req){
        $data = null;
        $db = new trainer();

        if($req->post()){
           if($req->post('t_in') && $req->post('t_out')){
            $in = $req->post('t_in');
            $out = $req->post('t_out');
            $data = DB::select("SELECT * FROM trainers WHERE date_of_joining BETWEEN '$in' and '$out'");
            if($data){
                $target = $data;
                return $target;
            }
           }
     
        }
        else{
            $data = $db::all();
            $target= $data;
            return $target;
        }
    }

    public function trainer_view($id)
    {
        $page_title = 'View Customer Profile';
        $page_description = 'Some description for the page';
        $action = __FUNCTION__;
        $db = new trainer();
        // $gym_fees = null;
        // $total_session = null;
        $data = $db::all()->find($id);
        $name = $data->first_name . ' ' .$data->last_name; 
        if($val = DB::select("select * from customers where trainer_name = '$name'")){
            $gym_fees = DB::select("SELECT SUM(gym_fees) as gym_fees FROM `customers` where trainer_name = '$name'");
            $total_session = DB::select("SELECT SUM(total_session) as tsession FROM `customers` where trainer_name = '$name'");

        }
        else{
            $val = ['Trainer has no more Cliens'];
        }
        // dd($gym_fees);
        return view('trainer.view', compact('page_title', 'page_description', 'action'), [
            'datas' => $data,
            'customer'=>$val,
            'fees'=> $gym_fees,
            'tsession'=> $total_session
        ]);
    }

    // Delete Function
    public function trainer_delete($id)
    {
        $db = new trainer();
        $data = $db::all()->find($id);
        $name = $data->first_name.' '. $data->last_name;
        DB::select("UPDATE `customers` SET `trainer_name`='UA' WHERE trainer_name = '$name'");
        $data->delete();
        return redirect('manage-trainer');
    }

    // Update view Function
    public function update_trainer($id)
    {
        $page_title = 'Update Trainer';
        $page_description = 'Some description for the page';
        $action = __FUNCTION__;
        $db = new trainer();
        $data = $db::all()->find($id);
        return view('trainer.update', compact('page_title', 'page_description', 'action'), ['datas' => $data]);
    }
    // Function Update
    public function update(Request $req)
    {
        $db = new trainer();
        $data = $db::all()->find($req->id);
        $data->first_name = $req->firstName;
        $data->last_name = $req->lastName;
        $data->email = $req->email;
        $data->phone_number = $req->phoneNumber;
        $data->address = $req->place;
        $data->date_of_birth = $req->dob;
        $data->date_of_joining = $req->doj;
        $data->cnic = $req->cnic;
        $data->fixed_salary = $req->fixed_salary;
        $data->commision = $req->commision;
        $data->timing_in = $req->tin;
        $data->timing_out = $req->tout;
        // Image Section
        if ($req->file('tfile')) {
            $image_original = $req->file('tfile');
            $extension = $image_original->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $image_original->move('upload/trainers_images/', $fileName);
            $data->image = $fileName;
        }
        if ($data->save()) {
            return redirect('manage-trainer');
        } else {
            return redirect('manage-trainer');
        }
    }

    public function schedule_manage($id)
    {

        $db = new trainer();
        $data = $db::all()->find($id);
        $name = $data->first_name . ' ' . $data->last_name;
        // Customer Data Fetch for Schedule Management
        $monday = DB::select("select id, first_name, last_name, phone_number, email,  mon_start_time, mon_end_time  from customers where trainer_name = '$name' and mon_allow_pt = 'yes'");
        $tuesday = DB::select("select id, first_name, last_name, phone_number, email,  tue_start_time, tue_end_time  from customers where trainer_name = '$name' and tue_allow_pt = 'yes'");
        $wednesday = DB::select("select id, first_name, last_name, phone_number, email,  wed_start_time, wed_end_time  from customers where trainer_name = '$name' and wed_allow_pt = 'yes'");
        $thursday = DB::select("select id, first_name, last_name, phone_number, email,  thu_start_time, thu_end_time  from customers where trainer_name = '$name' and thu_allow_pt = 'yes'");
        $friday = DB::select("select id, first_name, last_name, phone_number, email,  fri_start_time, fri_end_time  from customers where trainer_name = '$name' and fri_allow_pt = 'yes'");
        $saturday = DB::select("select id, first_name, last_name, phone_number, email,  sat_start_time, sat_end_time  from customers where trainer_name = '$name' and sat_allow_pt = 'yes'");
        $sunday = DB::select("select id, first_name, last_name, phone_number, email,  sun_start_time, sun_end_time  from customers where trainer_name = '$name' and sun_allow_pt = 'yes'");

        $page_title = 'Trainers Schedule';
        $page_description = 'Some description for the page';
        $action = __FUNCTION__;
        return view('trainer.schedule', compact('page_title', 'page_description', 'action'), ['trainer_name' => $name, 'mondaysch' => $monday, 'tuesdaysch' => $tuesday, 'wednesdaysch' => $wednesday, 'thursdaysch' => $thursday, 'fridaysch' => $friday, 'saturdaysch' => $saturday, 'sundaysch' => $sunday,]);
    }
}
