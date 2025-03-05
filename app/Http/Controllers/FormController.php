<?php

namespace App\Http\Controllers;

use App\Models\Mst_documents;
use App\Models\Mst_education;
use App\Models\Mst_experience;
use App\Models\Mst_Form_s_w;
use App\Models\mst_workflow;
use App\Models\Payment;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function store(Request $request)
    {
        $action = $request->input('form_action');
        $loginId = $request->login_id_store;
        $timestamp = time();

        // Generate New Application ID
        $lastApplication = Mst_Form_s_w::latest('id')->value('application_id');
        if ($lastApplication) {
            $lastNumber = (int) substr($lastApplication, -7);
            $newApplicationId = $request->license_name . date('y') . str_pad($lastNumber + 1, 7, '0', STR_PAD_LEFT);
        } else {
            $newApplicationId = $request->license_name . date('y') . '1111111';
        }
        // $validator = FacadesValidator::make($request->all(), [
        //     'Applicant_Name' => 'required|string|max:255',
        //     'Fathers_Name' => 'required|string|max:255',
        //     'applicants_address' => 'required|string|max:500',
        //     'd_o_b' => 'required|date',
        //     'age' => 'required|integer|min:1|max:120',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        // Store or Update Form
        $form = Mst_Form_s_w::create(
            // ['login_id' => $request->login_id_store],
            [
                'login_id' => $request->login_id_store,
                'applicant_name' => $request->Applicant_Name,
                'fathers_name' => $request->Fathers_Name,
                'applicants_address' => $request->applicants_address,
                'd_o_b' => $request->d_o_b,
                'age' => $request->age,
                'previously_number' => $request->previously_number ?? 0,
                'previously_date' => $request->previously_date ?? 0,
                'login_id' => $request->login_id_store,
                'application_id' => $newApplicationId,
                'wireman_details' => $request->wireman_details,
                'form_name' => $request->form_name,
                'license_name' => $request->license_name,
                'status' => ($action === 'draft') ? 'draft' : 'payment',
            ]
        );

        // return $form;
        // exit;

        
        if ($request->has('educational_level')) {
            $edu_serial = Mst_education::latest('id')->value('edu_serial');
            $newedu = $edu_serial ? 'edu_' . ((int) substr($edu_serial, 4) + 1) : 'edu_1';



            foreach ($request->educational_level as $key => $level) {
                Mst_education::create([
                    'login_id' => $loginId,
                    'educational_level' => $level,
                    'institute_name' => $request->institute_name[$key],
                    'year_of_passing' => $request->year_of_passing[$key],
                    'percentage' => $request->percentage[$key],
                    'application_id' => $newApplicationId,
                    'edu_serial' => $newedu,
                ]);
            }
        }

        
        if ($request->has('work_level')) {
            $exp_serial = Mst_experience::latest('id')->value('exp_serial');
            $newexp = $exp_serial ? 'exp_' . ((int) substr($exp_serial, 4) + 1) : 'exp_1';

            foreach ($request->work_level as $key => $company) {
                
                if (empty($company) || empty($request->experience[$key]) || empty($request->Designation[$key])) {
                    continue; 
                }

                Mst_experience::create([
                    'login_id' => $loginId,
                    'company_name' => $company,
                    'experience' => $request->experience[$key],
                    'designation' => $request->Designation[$key],
                    'application_id' => $newApplicationId,
                    'exp_serial' => $newexp,
                ]);
            }
        }


        // Store Documents as Base64 in Database
        $photoBase64 = null;
        if ($request->hasFile('upload_photo')) {
            $photoBase64 = base64_encode(file_get_contents($request->file('upload_photo')));
        }

        $request->validate([
            'upload_photo' => 'required|mimes:jpg,png|max:50', // Max size is in KB
        ], [
            'upload_photo.required' => 'Photo upload is required.',
            'upload_photo.mimes' => 'Only JPG and PNG formats are allowed.',
            'upload_photo.max' => 'File size must not exceed 50 KB.',
        ]);


        $signBase64 = null;
        if ($request->hasFile('upload_sign')) {
            $signBase64 = base64_encode(file_get_contents($request->file('upload_sign')));
        }

        // Store Education Documents as Base64
        $educationDocs = [];
        if ($request->hasFile("education_document")) {
            foreach ($request->file("education_document") as $file) {
                $educationDocs[] = base64_encode(file_get_contents($file));
            }
        }

        // Store Work Experience Documents as Base64
        $workDocs = [];
        if ($request->hasFile("work_document")) {
            foreach ($request->file("work_document") as $file) {
                $workDocs[] = base64_encode(file_get_contents($file));
            }
        }

        // Insert into Mst_documents table
        Mst_documents::create([
            'login_id' => $loginId,
            'education_serial' => $newedu,
            'experience_serial' => $newexp,
            'education_doc' => !empty($educationDocs) ? json_encode($educationDocs) : null,
            'experience_doc' => !empty($workDocs) ? json_encode($workDocs) : null,
            'upload_photo' => $photoBase64,
            'upload_sign' => '0',
            'application_id' => $newApplicationId,
        ]);


        if ($action === 'payment') {
            $transactionId = 'TXN' . rand(100000, 999999);

            Payment::create([
                'login_id' => $loginId,
                'application_id' => $newApplicationId,
                'transaction_id' => $transactionId,
                'payment_status' => 'success',
                'form_name' => $form->form_name,
                'license_name' => $form->license_name,
            ]);

            mst_workflow::create([
                'login_id' => $loginId,
                'application_id' => $newApplicationId,
                'transaction_id' => $transactionId,
                'payment_status' => 'success',
                'formname_appliedfor' => $form->form_name,
                'license_name' => $form->license_name,
            ]);

            return response()->json([
                'message' => 'Payment Processed!',
                'login_id' => $newApplicationId
            ]);
        }

        return response()->json([
            'message' => 'Form saved successfully!',
            'login_id' => $newApplicationId
        ]);



        // return redirect()->back()->with('success', 'Form saved as draft!');
    }
}
