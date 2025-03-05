<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mst_Form_s_w;
use App\Models\Mst_education;
use App\Models\Mst_experience;
use App\Models\Mst_documents;
use Illuminate\Support\Facades\DB;
use TCPDF;
use Mpdf\Mpdf;
use Stichoza\GoogleTranslate\GoogleTranslate;

class PDFController extends Controller
{
    public function generatePDF($newApplicationId)
    {

        // return $newApplicationId;
        // exit;
        // Fetch form details
        $form = Mst_Form_s_w::where('application_id', $newApplicationId)->first();
        $education = Mst_education::where('application_id', $newApplicationId)->get();
        $experience = Mst_experience::where('application_id', $newApplicationId)->get();
        $documents = Mst_documents::where('application_id', $newApplicationId)->first();
        $payment = DB::table('payments')->where('application_id', $newApplicationId)->first();

        if (!$form) {
            return redirect()->back()->with('error', 'No records found!');
        }

        // Initialize mPDF
        // $mpdf = new Mpdf();
        $mpdf = new Mpdf(['default_font_size' => 10]);
        $mpdf->SetFont('helvetica', '', 10);
        $mpdf->WriteHTML('<style> 
            body { line-height: 0.8; } 
            p, td, th { line-height: 2.0; padding: 2px; }
             td, th { line-height: 2.0; padding: 2px; }
             h3, h4, p {
            margin: 2px 0; /* Reduces top & bottom margin */
            line-height: 1.5; /* Adjusts spacing between lines */
        }
            .tbl_center tr td{
            text-align:center;
            }
            .mt-2{

            margin-top:10px;
    }
        </style>', \Mpdf\HTMLParserMode::HEADER_CSS);


        $mpdf->SetTitle('TNELB Application License ' . $form->license_name);

        // Application Title
        $html = '
        <h3 style="text-align: center;">GOVERNMENT OF TAMILNADU</h3>
        <h4 style="text-align: center;">THE ELECTRICAL LICENSING BOARD</h4>
        <p style="text-align: center;">Thiru.Vi.Ka.Indl.Estate, Guindy, Chennai – 600032.</p>
        <h4 style="text-align: center;">Form "'.$form->license_name.'"</h4>
        <p style="text-align: center;">Application for Supervisor Competency Certificate</p>
        ';

        // Applicant Details
        $html .= '
        <table width="100%"  style="border-collapse: collapse;">
            <tr>
                <td width="5%"></td>
                <td width="65%"></td>
                <td width="30%" rowspan="5" style="text-align: center; vertical-align: middle;">
    ';

        // Applicant Photo (if exists)
        if (!empty($documents->upload_photo)) {
            $base64_photo = $documents->upload_photo;
            $image_type = 'png'; // Default image type

            if (preg_match('/^data:image\/(\w+);base64,/', $base64_photo, $matches)) {
                $image_type = $matches[1];
                $base64_photo = substr($base64_photo, strpos($base64_photo, ',') + 1);
            }

            $photo_data = base64_decode($base64_photo);
            $photo_path = storage_path('app/public/photo.' . $image_type);
            file_put_contents($photo_path, $photo_data);

            if (file_exists($photo_path)) {
                // Append image to $html
                $html .= '<img src="' . $photo_path . '" width="150" height="150" >';
            }
        }

        $html .= '
                </td>
            </tr>
            <tr>
                <td>1.</td>
                <td><strong>Name of the applicant:</strong> ' . $form->applicant_name . '</td>
            </tr>
            <tr>
                <td>2.</td>
                <td><strong>Father\'s Name:</strong> ' . $form->fathers_name . '</td>
            </tr>
            <tr>
                <td>3.</td>
                <td><strong>Address:</strong> ' . nl2br($form->applicants_address) . '</td>
            </tr>
            <tr>
                <td>4.</td>
                <td><strong>Date of Birth & Age:</strong> ' . $form->d_o_b . ' (' . $form->age . ' years)</td>
            </tr>
        </table>
    ';



        // Educational Details
        $html .= '<h4 class="mt-2">5. Educational Details</h4>
        <table border="1" width="100%" cellspacing="0" cellpadding="5" class="text-center tbl_center" >
            <tr>
                <th>Education Level</th>
                <th>Institution</th>
                <th>Year of Passing</th>
                <th>Percentage</th>
            </tr>';

        foreach ($education as $edu) {
            $html .= '<tr >
                <td class="text-center">' . $edu->educational_level . '</td>
                <td class="text-center">' . $edu->institute_name . '</td>
                <td class="text-center">' . $edu->year_of_passing . '</td>
                <td class="text-center">' . $edu->percentage . '%</td>
            </tr>';
        }
        $html .= '</table>';

        // Work Experience
        $html .= '<h4 class="mt-2">6. Work Experience</h4>
        <table border="1" width="100%" cellspacing="0" cellpadding="5" class="tbl_center">
            <tr>
                <th>Company Name</th>
                <th>Experience (Years)</th>
                <th>Designation</th>
            </tr>';

        foreach ($experience as $exp) {
            $html .= '<tr>
                <td>' . $exp->company_name . '</td>
                <td>' . $exp->experience . '</td>
                <td>' . $exp->designation . '</td>
            </tr>';
        }
        $html .= '</table>';

        // Previous Application Details
        $previously = ($form->previously_number && $form->previously_date) ? $form->previously_number . ', ' . $form->previously_date : 'NO';
        // <h4> Previous Applications</h4>
        $wireman_details = ($form->wireman_details) ? $form->wireman_details . ', ' . $form->wireman_details : 'NO';
        $html .= '
    <table  width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse;" class="mt-2">
        <tr>
            <td width="70%">
                <strong>7. </strong>Have you made any previous application?<br>
                If so, state reference Number and date
            </td>
            <td width="30%"> : ' . $previously . '</td>
        </tr>
        <tr>
            <td width="70%">
                <strong>8. </strong>Do you possess Wireman C.C / Wireman Helper C.C issued by this Board?<br>
                If so, furnish the details and surrender the same.
            </td>
            <td width="30%"> : ' . $wireman_details . '</td>
        </tr>
    </table>';



        // Payment Details
        $html .= '<h4 class="mt-2">9. Payment Details</h4>
        <table border="1" width="100%" cellspacing="0" cellpadding="5" class="tbl_center">
            <tr>
                <th>Bank Name</th>
                <th>Mode of Payment</th>
                <th>Payment Date</th>
                <th>Transaction ID</th>
            </tr>
            <tr>
                <td>State Bank of India</td>
                <td>UPI</td>
                <td>25-02-2025</td>
                <td>' . ($payment->transaction_id ?? 'N/A') . '</td>
            </tr>
        </table>
        ';

        // Declaration
        $html .= '
        <p class="mt-2">I hereby declare that all details mentioned above are correct and true to the best of my knowledge.</p>
        <p class="mt-2">I request that I may be granted a Supervisor Competency Certificate.</p>
        <br>
        <br>
        <br>
     
        <br>
        <p><strong>Place:</strong> Chennai</p>
        <p><strong>Date:</strong> ' . date('d-m-Y') . '</p>
      
        
        <p style="text-align: right;"><strong>Signature of the Candidate</strong></p>';



        // Write HTML to PDF
        $mpdf->WriteHTML($html);

        // Output PDF
        return response($mpdf->Output('Application_Details.pdf', 'I'))
            ->header('Content-Type', 'application/pdf');
    }

    public function generatetcp($newApplicationId)
    {
        // Fetch form details
        $form = Mst_Form_s_w::where('application_id', $newApplicationId)->first();
        $education = Mst_education::where('application_id', $newApplicationId)->get();
        $experience = Mst_experience::where('application_id', $newApplicationId)->get();
        $documents = Mst_documents::where('application_id', $newApplicationId)->first();
        $payment = DB::table('payments')->where('application_id', $newApplicationId)->first();

        if (!$form) {
            return redirect()->back()->with('error', 'No records found!');
        }

        // Create a new TCPDF instance
        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetCreator('TNELB');
        $pdf->SetAuthor('Your App');
        $pdf->SetTitle('TamilNadu Government');
        $pdf->SetMargins(10, 5, 10);
        $pdf->AddPage();

        // Application Title
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(0, 5, 'GOVERNMENT OF TAMILNADU', 0, 1, 'C');

        $pdf->Cell(0, 5, 'THE ELECTRICAL LICENSING BOARD', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 5, 'Thiru.Vi.Ka.Indl.Estate, Guindy. Chennai – 600032.', 0, 1, 'C');
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(0, 5, 'Form "S"', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 5, 'Application for Supervisor Competency Certificate', 0, 1, 'C');
        $pdf->Ln(2);

        // Load and display applicant photo (Right side)
        if (!empty($documents->upload_photo)) {
            $photoPath = public_path($documents->upload_photo);

            if (file_exists($photoPath)) {
                $pdf->Image($photoPath, 150, 35, 40, 40);
            }
        }

        // Set font for content
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Ln(0);

        // Application Details (Left side)

        // $pdf->Cell(50, 10, 'Name of the applicant ', 0, 0);
        // $pdf->Cell(100, 10, ': ' . $form->application_id, 0, 1);
        // Name of the applicant
        $pdf->Cell(50, 9, '1. Name of the applicant', 0, 0);
        $pdf->Cell(5, 9, ':', 0, 0, 'C'); // Centered colon
        $pdf->Cell(85, 9, $form->applicant_name, 0, 1, 'L'); // Left-aligned value

        // Father's Name
        $pdf->Cell(50, 9, '2. Father\'s Name', 0, 0);
        $pdf->Cell(5, 9, ':', 0, 0, 'C');
        $pdf->Cell(85, 9, $form->fathers_name, 0, 1, 'L');

        // Address of the applicant (Use MultiCell to wrap text properly)
        $pdf->Cell(50, 9, '3. Address of the applicant', 0, 0);
        $pdf->Cell(5, 9, ':', 0, 0, 'C');
        $pdf->MultiCell(85, 9, $form->applicants_address, 0, 'L'); // Address wraps properly

        // Date of Birth and Age
        $pdf->Cell(50, 9, '4. Date of Birth and Age', 0, 0);
        $pdf->Cell(5, 9, ':', 0, 0, 'C');
        $pdf->Cell(85, 9, $form->d_o_b . ', ' . $form->age, 0, 1, 'L');

        // $pdf->Cell(50, 9, 'License Applied For', 0, 0);
        // $pdf->Cell(100, 9, ': ' . ($payment->license_name ?? 'N/A'), 0, 1);
        // $pdf->Cell(50, 9, 'Form Name', 0, 0);
        // $pdf->Cell(100, 9, ': ' . ($payment->form_name ?? 'N/A'), 0, 1);
        // $pdf->Ln(1);

        // Educational Details Section
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 10, '5. Details of Technical Qualification passed by the applicant', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Ln(1);
        // Table Header
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(40, 7, 'Education Level', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Institution/School Name', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Year of Passing', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Percentage / Grade', 1, 1, 'C');  // End the row with a line break

        // Reset font for content
        $pdf->SetFont('helvetica', '', 10);

        $eduCount = count($education);
        $expCount = count($experience);

        foreach ($education as $edu) {
            $pdf->Cell(40, 7, $edu->educational_level, 1, 0, 'C');
            $pdf->Cell(50, 7, $edu->institute_name, 1, 0, 'C');
            $pdf->Cell(40, 7, $edu->year_of_passing, 1, 0, 'C');
            $pdf->Cell(50, 7, $edu->percentage . '%', 1, 1, 'C');
        }

        // Add some space below the table
        $pdf->Ln(1);


        // Work Experience Section
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 10, '6. Details of Past and Present Experience', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 10);

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(60, 7, 'Company Name / Contractor', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Years of Experience', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Designation', 1, 1, 'C'); // End the row with a line break

        // Reset font for content
        $pdf->SetFont('helvetica', '', 10);

        // Loop through work experience data and populate the table
        foreach ($experience as $exp) {
            $pdf->Cell(60, 7, $exp->company_name, 1, 0, 'C');
            $pdf->Cell(50, 7, $exp->experience . ' years', 1, 0, 'C');
            $pdf->Cell(50, 7, $exp->designation, 1, 1, 'C');
        }
        $pdf->Ln(2); // Add space before the question
        $pdf->SetFont('helvetica', '', 10);
        // $pdf->writeHTML('<p style="margin-bottom:5px;">7.Have you made any previous application?</p>', true, false, true, false, '');
        // $pdf->writeHTML('<p>If so, state reference No and date:</p>', true, false, true, false, '');
        $pdf->Ln(2);


        $pdf->Cell(100, 5, '7. Have you made any previous application?', 0, 1, 'L');
        $pdf->Cell(135, 5, 'If so, state reference Number and date', 0, 0, 'L');

        if ($form->previously_number != 0 && $form->previously_date != 0) {
            $pdf->Cell(90, 5, ': ' . $form->previously_number . ', ' . $form->previously_date, 0, 1, 'L');
        } else {
            $pdf->Cell(90, 5, ': NO', 0, 1, 'L');
        }
        $pdf->Ln(1);

        $pdf->Cell(100, 5, '8. Do you possess Wireman C.C / Wireman Helper C.C issued by this Board?', 0, 1, 'L');
        $pdf->Cell(135, 5, 'If so, furnish the details and surrender the same.', 0, 0, 'L');

        if ($form->wireman_details) {
            $pdf->Cell(20, 9, '', 0, 0);
            $pdf->Cell(130, 9, ': ' . $form->wireman_details, 0, 1, 'L');
        } else {

            $pdf->Cell(130, 5, ': NO', 0, 1, 'L');
        }
        // Wireman Certificate

        // $pdf->Cell(100, 9, '8. Do you possess Wireman C.C / Wireman Helper C.C issued by this Board?', 0, 1, 'L');

        // $pdf->Cell(135, 9, 'If so, furnish the details and surrender the same.', 0, 1, 'L');

        // if ($form->wireman_details) {
        //     $pdf->Cell(20, 9, '', 0, 0);
        //     $pdf->Cell(130, 9, ': ' . $form->wireman_details, 0, 1, 'L');
        // } else {
        //     $pdf->Cell(20, 9, '', 0, 0);
        //     $pdf->Cell(130, 9, ': NO', 0, 1, 'L');
        // }

        $pdf->Ln(1);

        // Demand Draft Details
        $pdf->Cell(10, 9, '9.', 0, 0, 'L');
        $pdf->Cell(150, 9, 'Demand Draft Details', 0, 1, 'L');

        // Table Header
        $pdf->Cell(40, 10, 'Bank Name', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Mode Of Payment', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Payment Date', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Transaction ID', 1, 1, 'C');

        // Payment details row
        $pdf->Cell(40, 10, 'State Bank of India', 1, 0, 'C');
        $pdf->Cell(50, 10, 'UPI', 1, 0, 'C');
        $pdf->Cell(40, 10, '25-02-2025', 1, 0, 'C');
        $pdf->Cell(50, 10, $payment->transaction_id ?? 'N/A', 1, 1, 'C');

        $pdf->Ln(3);

        $pdf->SetFont('helvetica', '', 10);

        // First line (auto-wrap)
        $pdf->MultiCell(0, 10, 'I hereby declare that all the details mentioned above are correct and true to the best of my knowledge.', 0, 'L');


        $pdf->Ln(1);

        // Second line (auto-wrap)
        $pdf->MultiCell(0, 10, 'I request that I may be granted a Supervisor Competency Certificate.', 0, 'L');

        $pdf->Ln(12);

        $pdf->Cell(20, 10, 'Place:', 0, 0);
        $pdf->Cell(60, 10, ': Chennai', 0, 0, 'L');
        $pdf->SetX(110);
        $pdf->Cell(60, 10, '', 0, 1, 'C');

        $pdf->Cell(20, 10, 'Date:', 0, 0);
        $pdf->Cell(60, 10, ': ' . date('d-m-Y'), 0, 0, 'L');


        // if (!empty($documents->upload_sign)) {
        //     $signPath = public_path($documents->upload_sign);

        //     if (file_exists($signPath)) {
        //         $pdf->Image($signPath, 132, 25, 30, 30);
        //     }
        // }
        $pdf->Cell(80, 10, 'Signature of the Candidate', 0, 1, 'R');

        $pdf->Output('Application_Details.pdf', 'I');
    }


    public function generateTamilPDF($newApplicationId)
    {
        $form = Mst_Form_s_w::where('application_id', $newApplicationId)->first();
        $education = Mst_education::where('application_id', $newApplicationId)->get();
        $experience = Mst_experience::where('application_id', $newApplicationId)->get();
        $documents = Mst_documents::where('application_id', $newApplicationId)->first();
        $payment = DB::table('payments')->where('application_id', $newApplicationId)->first();

        if (!$form) {
            return redirect()->back()->with('error', 'பதிவுகள் கிடைக்கவில்லை!');
        }

        // Initialize mPDF with Marutham font
        $mpdf = new Mpdf([
            'mode' => 'utf-8'
        ]);


        $mpdf->SetDefaultFont('marutham');
        $mpdf->SetFont('marutham', '', 8);

        $mpdf->SetTitle('தமிழ்நாடு அரசு மின்சார உரிமையாளர்கள் வாரியம் படிவம் ' . $form->license_name);
        // CSS to ensure font is applied
        $mpdf->WriteHTML('', \Mpdf\HTMLParserMode::HEADER_CSS);

        $license_name_tamil = GoogleTranslate::trans($form->license_name, 'ta', 'en');
        // Tamil Content
        $html = '
           <style>
	.tam
	{
		font-family:marutham !important;
		font-size:12px !important;
	}

   
            body {
                font-family: "marutham", sans-serif;
                line-height: 1.5;
                font-size:14px !important;
                
            }
            h3, h4 {
       
                margin: 5px 0;
                font-weight:600;
                
               
            }
                .text-center{
                         text-align: center;
                }
            p {
                
                margin: 5px 0;
                
            }
            table {
                width: 100%;
                border-collapse: collapse;
                
            }
                table tr th{
                font-weight:600;
    }
                p strong{
                font-weight:600;
                }
            th, td {
                border:1px solid #000;
                padding: 5px;
                text-align: center;
            }
                .mt-10{
                margin-top:5px;
    }
                .applicant_details tr td{
                text-align:left;
                border:none;
    }
        .license_tbl tr td{
                text-align:left;
                border:none;
                line-height:25px;
    }
</style>
        <div class="text-center">
        <h3><span class="tam">தமிழ்நாடு அரசு</span></h3>
        <h4>மின்சார உரிமையாளர்கள் வாரியம்</h4>
        <p>திரு.வி.கா. தொழிற்சாலை, கிண்டி, சென்னை – 600032.</p>
        <h4>படிவம் "'.$form->form_name.' "</h4>
        <p>மேற்பார்வையாளர் தகுதிச் சான்றிதழுக்கான விண்ணப்பம்</p>
        </div>
        <div>
     ';

     $html .= '
    <table class="applicant_details" width="100%"  style="border-collapse: collapse;">
        <tr>
            <td width="5%"></td>
            <td width="65%"></td>
            <td width="30%" rowspan="5" style="text-align: center; vertical-align: middle;">
';

// Applicant Photo (if exists)
if (!empty($documents->upload_photo)) {
    $base64_photo = $documents->upload_photo;
    $image_type = 'png'; // Default image type

    if (preg_match('/^data:image\/(\w+);base64,/', $base64_photo, $matches)) {
        $image_type = $matches[1];
        $base64_photo = substr($base64_photo, strpos($base64_photo, ',') + 1);
    }

    $photo_data = base64_decode($base64_photo);
    $photo_path = storage_path('app/public/photo.' . $image_type);
    file_put_contents($photo_path, $photo_data);

    if (file_exists($photo_path)) {
        // Append image to $html
        $html .= '<img src="' . $photo_path . '" width="150" height="150" >';
    }
}

$html .= '
            </td>
        </tr>
        <tr>
            <td>1.</td>
            <td>விண்ணப்பதாரரின் பெயர்: ' . $form->applicant_name . '</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>தந்தையின் பெயர்:' . $form->fathers_name . '</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>முகவரி: ' . nl2br($form->applicants_address) . '</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>பிறந்த தேதி & வயது ' . $form->d_o_b . ' (' . $form->age . ' years)</td>
        </tr>
    </table>
';



        $html .= '<h4 class="mt-10">5. கல்வித் தகுதி</h4>
        <table>
            <tr>
                <th>கல்வி நிலை</th>
                <th>கல்லூரி / பள்ளி</th>
                <th>தேர்ச்சி பெற்ற ஆண்டு </th>
                <th>சதவீதம்</th>
            </tr>';

        foreach ($education as $edu) {
            $html .= '<tr>
                <td>' . $edu->educational_level . '</td>
                <td>' . $edu->institute_name . '</td>
                <td>' . $edu->year_of_passing . '</td>
                <td>' . $edu->percentage . '%</td>
            </tr>';
        }
        $html .= '</table>';

        // Work Experience
        $html .= '<h4 class="mt-10">6. பணிப் பரிசோதனை</h4>
        <table>
            <tr>
                <th>நிறுவனம்</th>
                <th>அனுபவம் (ஆண்டுகள்)</th>
                <th>பதவி</th>
            </tr>';

        foreach ($experience as $exp) {
            $html .= '<tr>
                <td>' . $exp->company_name . '</td>
                <td>' . $exp->experience . '</td>
                <td>' . $exp->designation . '</td>
            </tr>';
        }
        $html .= '</table>';


        $previously = ($form->previously_number && $form->previously_date) ? $form->previously_number . ', ' . $form->previously_date : 'இல்லை';

        $wireman_details = ($form->wireman_details) ? $form->wireman_details . ', ' . $form->wireman_details : 'இல்லை';

        $html .= '
    <table class="license_tbl" width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <td width="80%">
                <strong>7. </strong>இதற்கு முன் விண்ணப்பித்தீர்களா?<br>
                முந்தைய விண்ணப்ப எண்:
            </td>
            <td width="30%">: ' . $previously . '</td>
        </tr>
        <tr>
            <td width="80%">
                <strong>8. </strong>இந்த வாரியத்தால் வழங்கப்பட்ட வயர்மேன் C.C / Wireman Helper C.C உங்களிடம் உள்ளதா?<br>
                அப்படியானால், விவரங்களை அளித்து அதையே சரணடையவும்.
            </td>
            <td width="30%">: ' . $wireman_details . '</td>
        </tr>
    </table>';



        $html .= '<h4 class="mt-10">9. கட்டண விவரங்கள்</h4>
        <table>
            <tr>
                <th>வங்கி பெயர்</th>
                <th>கட்டண வகை</th>
                <th>கட்டண தேதி</th>
                <th>பரிவர்த்தனை எண்</th>
            </tr>
            <tr>
                <td>State Bank of India</td>
                <td>UPI</td>
                <td>25-02-2025</td>
                <td>' . ($payment->transaction_id ?? 'தகவல் இல்லை') . '</td>
            </tr>
        </table>';


        $html .= '
        <p class="mt-10">மேற்கூறிய தகவல்கள் அனைத்தும் உண்மை என்பதை உறுதிப்படுத்துகிறேன்.</p>
        <p>தயவுசெய்து எனக்கு மேற்பார்வையாளர் தகுதிச் சான்றிதழ் வழங்கவும்.</p><br><br><br><br>
        <p><strong>இடம்:</strong> சென்னை</p>
        <p><strong>தேதி:</strong> ' . date('d-m-Y') . '</p>
        <p style="text-align: right;"><strong>விண்ணப்பதாரரின் கையொப்பம்</strong></p>';

        // Convert to UTF-8
        $html = mb_convert_encoding($html, 'UTF-8', 'auto');

        // Write to PDF
        $mpdf->WriteHTML($html);

        // Output PDF
        return response($mpdf->Output('Application_Tamil.pdf', 'I'))
            ->header('Content-Type', 'application/pdf');
    }
}
