<?php
$d_none_row = 'style="padding: 10px 5px;display: none;"';
$b_none_row = "style='padding: 10px 5px;display: table-cell;'";

if(isset($d_default_q_name)){
	$default_q_name = $d_default_q_name;
} else{
	$default_q_name = 'CYCLE 1';
}

if($report_type == 2){
	$dynmic_arr1 = 0;
	$dynmic_arr2 = 1;
}else{
	$dynmic_arr1 = 2;
	$dynmic_arr2 = 3;
}

$athlete_age_Category = strtoupper($athlete_age_Category);
$athlete_playing_position = strtoupper($athlete_playing_position);


$html = '';
$footer = '';
$html = '<section style="page-break-after:always">
    <div style=" margin: 30px 0; background: #FFC000; padding: 20px 60px">
        <div style="text-align: center;color: #002060;padding: 15px 41px;font-weight: 500;font-size: 35px;border-bottom: 3px solid #002060;margin: 10px auto;">INTERNATIONAL FOOTBALL<br>EXCELLENCE PROGRAM</div>
        <div style="width: 300px;margin: 45px auto;text-align: center;">
        <img style="width: 200px;" src="'.base_url('/assets/img/pdflogo-300.png').'">
        </div>

        <div style="text-align: center;color: #002060;padding: 15px 41px;font-weight: 500;font-size: 26px;border-bottom: 3px solid #002060;margin: 10px auto;">'.$report_heading.'</div>

        <div style="text-align: center;color: #002060;padding: 15px 41px;font-weight: 500;font-size: 26px;margin: 10px auto;">'.$athlete_name.'</div>

        
    </div>

    <div style="padding: 10px 60px">
        <div style="text-align: left;color: #002060;padding: 15px 0;font-weight: 500;font-size: 26px;border-bottom: 3px solid #002060;margin: 10px auto;">ATHLETE AGE GROUP</div>
        <div style="text-align: left;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;margin: 10px auto;">'.$athlete_age_Category.'</div>
    </div>

    <div style="padding: 10px 60px">
        <div style="text-align: left;color: #002060;padding: 15px 0;font-weight: 500;font-size: 26px;border-bottom: 3px solid #002060;margin: 10px auto;">PLAYING POSITION</div>
        <div style="text-align: left;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;margin: 10px auto;">'.$athlete_playing_position.'</div>
    </div>

</section>';
?>


<?php
/* ==========================================================
 * TECHNICAL SKILLS / DEVELOPMENT PLAN
 * Display each database record as a separate PLAN box
 * ========================================================== */

if (!empty($techical_overview) && is_array($techical_overview)) {

    foreach ($techical_overview as $skill_index => $overview) {

        $skill_number = $skill_index + 1;

        $development_area_1 = isset($overview['development_area_1'])
            ? htmlspecialchars($overview['development_area_1'], ENT_QUOTES, 'UTF-8')
            : '';

        $development_area_2 = isset($overview['development_area_2'])
            ? htmlspecialchars($overview['development_area_2'], ENT_QUOTES, 'UTF-8')
            : '';

        $individual_development_plan = isset($overview['individual_development_plan'])
            ? nl2br(htmlspecialchars($overview['individual_development_plan'], ENT_QUOTES, 'UTF-8'))
            : '';

        $remark = isset($overview['remark'])
            ? nl2br(htmlspecialchars($overview['remark'], ENT_QUOTES, 'UTF-8'))
            : '';


        /*
         * Each skill is a separate box
         */
        $html .= '
        <section style="page-break-inside: avoid; margin-bottom: 20px;">

            <div style="padding: 0px 52px;">

                <table style="
                    width: 100%;
                    border-collapse: collapse;
                    border: 1px solid #002060;
                ">

                    <!-- PLAN TITLE -->
                    <tr style="background-color: #FFC000;">

                        <td colspan="3"
                            style="
                                padding: 12px 10px;
                               
                                text-transform: uppercase;
                            ">
                            PLAN '.$skill_number.'
                        </td>

                    </tr>


                    <!-- DEVELOPMENT AREA 1 -->
                    <tr>

                        <td style="
                            width: 40%;
                            padding: 10px 5px;                            
                            text-transform: uppercase;
                            
                        ">
                            DEVELOPMENT AREA 1
                        </td>

                        <td style="
                            width: 10%;
                            padding: 10px 5px;
                            
                        ">
                        </td>

                        <td style="
                            width: 50%;
                            padding: 10px 5px;
                            
                        ">
                            '.$development_area_1.'
                        </td>

                    </tr>


                    <!-- DEVELOPMENT AREA 2 -->
                    <tr>

                        <td style="
                            width: 40%;
                            padding: 10px 5px;
                            text-transform: uppercase;
                            
                        ">
                            DEVELOPMENT AREA 2
                        </td>

                        <td style="
                            width: 10%;
                            padding: 10px 5px;
                            
                        ">
                        </td>

                        <td style="
                            width: 50%;
                            padding: 10px 5px;
                            
                        ">
                            '.$development_area_2.'
                        </td>

                    </tr>


                    <!-- INDIVIDUAL DEVELOPMENT PLAN -->
                    <tr>

                        <td style="
                            width: 40%;
                            padding: 10px 5px;                           
                            text-transform: uppercase;
                            
                            vertical-align: top;
                        ">
                            INDIVIDUAL DEVELOPMENT PLAN
                        </td>

                        <td style="
                            width: 10%;
                            padding: 10px 5px;
                            
                            vertical-align: top;
                        ">
                        </td>

                        <td style="
                            width: 50%;
                            padding: 10px 5px;
                            
                            vertical-align: top;
                        ">
                            '.$individual_development_plan.'
                        </td>

                    </tr>

                     <!-- REMARK -->
                    <tr>

                        <td style="
                            width: 40%;
                            padding: 10px 5px;                           
                            text-transform: uppercase;
                            
                            vertical-align: top;
                        ">
                            REMARK
                        </td>

                        <td style="
                            width: 10%;
                            padding: 10px 5px;
                            
                            vertical-align: top;
                        ">
                        </td>

                        <td style="
                            width: 50%;
                            padding: 10px 5px;
                            
                            vertical-align: top;
                        ">
                            '.$remark.'
                        </td>

                    </tr>

                </table>

            </div>

        </section>';
    }

} else {

    $html .= '
    <section>
        <div style="padding: 20px 52px;">
            No development plan records found.
        </div>
    </section>';
}


$footer .= '<section>
        <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">Thank You</div>
        <div style=" padding: 20px 20px; text-align: center;">
        <h3>ALCHEMY INTERNATIONAL FOOTBALL ACADEMY - OFFICIAL VILLARREAL ACADEMY</h3>
        <h3>080-49202025</h3>
        </div>
        </section>';


$html .= '';

//==============================================================

// print_r($html);
 // print_r($boday_overview[0]['body_composition_pdf']);
 // print_r($boday_overview[1]['body_composition_pdf']);
 //exit;


$filename = $report_name;

$mpdf = new \Mpdf\Mpdf();

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;	// 1 or 0 whether to indent the first level of a list


// LOAD a stylesheet
$stylesheet = file_get_contents(base_url('assets/dist/css/mpdfstyletables.css'));
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,2);

     
// $mpdf->AddPage();
// $mpdf->WriteHTML($footer,2);

// $mpdf->SetFooter($footer);

ob_clean();
// $mpdf->Output($filename.'.pdf','I');
$mpdf->Output($filename.'.pdf','D');

// $pagecount = $mpdf->SetSourceFile('./uploads/pdf/for_upload.pdf');
// $tplId = $mpdf->importPage($pagecount);
// $mpdf->useTemplate($tplId, null, null, 215.6, 350.9,FALSE);

// if(isset($boday_overview[0]['body_composition_pdf']) && !empty($boday_overview[0]['body_composition_pdf']) && file_exists('./uploads/bodycomposition_pdf/'.$boday_overview[0]['body_composition_pdf'])){
//     $pagecount = $mpdf->SetSourceFile('./uploads/bodycomposition_pdf/'.$boday_overview[0]['body_composition_pdf']);
//     $tplId = $mpdf->importPage($pagecount);
//     $mpdf->useTemplate($tplId, null, null, 215.6, 350.9,FALSE);
// }

// if($report_type == 3 && isset($boday_overview[1]['body_composition_pdf']) && !empty($boday_overview[1]['body_composition_pdf']) && file_exists('./uploads/bodycomposition_pdf/'.$boday_overview[1]['body_composition_pdf'])){
//     $pagecount = $mpdf->SetSourceFile('./uploads/bodycomposition_pdf/'.$boday_overview[1]['body_composition_pdf']);
//     $tplId = $mpdf->importPage($pagecount);
//     $mpdf->useTemplate($tplId, null, null, 215.6, 350.9,FALSE);
// }


// ob_clean();
// $mpdf->Output($filename.'.pdf','D');

// if($redirect_url){
// 	//redirect($redirect_url);
// }


/*
$mpdf->WriteHTML($html,2);
$content = $mpdf->Output($filename.'.pdf','S');

$fromMail = 'web@gmail.com';
$fromName = 'abcd';
$subject = 'Tetst';

$this->load->library('email');
$this->email->set_mailtype("html");
$this->email->set_newline("\r\n");
$this->email->from($fromMail, $fromName);
$this->email->to('webcoder2.nsquareit@gmail.com');
$this->email->subject($subject);
$this->email->attach($content, 'attachment', $filename, 'application/pdf');
$this->email->send();
*/
exit;

?>