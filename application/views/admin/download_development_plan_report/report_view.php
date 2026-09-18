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

/*
 * ==========================================================
 * COVER / ATHLETE INFORMATION
 * ==========================================================
 */

$html = '<section style="page-break-after:always">

    <div style="margin: 0px 0; background: #FFC000; padding: 20px 60px">

        <div style="
            text-align: center;
            color: #002060;
            padding: 15px 41px;
            font-weight: 500;
            font-size: 26px;
            border-bottom: 3px solid #002060;
            margin: 10px auto;
        ">
            '.$report_heading.'
        </div>

        <div style="
            text-align: center;
            color: #002060;
            padding: 15px 41px;
            font-weight: 500;
            font-size: 26px;
            margin: 10px auto;
        ">
            '.$athlete_name.'
        </div>

    </div>

    <div style="padding: 10px 10px;width: 50%;float: left;">

        <div style="
            text-align: left;
            color: #002060;
            padding: 15px 0;
            font-weight: 500;
            font-size: 22px;
            border-bottom: 3px solid #002060;
            margin: 10px auto;
        ">
            ATHLETE AGE GROUP
        </div>

        <div style="
            text-align: left;
            color: #002060;
            padding: 15px 0;
            font-weight: 500;
            font-size: 20px;
            margin: 10px auto;
        ">
            '.$athlete_age_Category.'
        </div>

    </div>

    <div style="padding: 10px 10px;width: 50%;float: left;">

        <div style="
            text-align: left;
            color: #002060;
            padding: 15px 0;
            font-weight: 500;
            font-size: 22px;
            border-bottom: 3px solid #002060;
            margin: 10px auto;
        ">
            PLAYING POSITION
        </div>

        <div style="
            text-align: left;
            color: #002060;
            padding: 15px 0;
            font-weight: 500;
            font-size: 20px;
            margin: 10px auto;
        ">
            '.$athlete_playing_position.'
        </div>

    </div>

</section>';


/*
 * ==========================================================
 * TECHNICAL PLAN
 * Each database record = one separate SKILL box
 * ==========================================================
 */

if(!empty($techical_overview) && is_array($techical_overview)) {

    foreach($techical_overview as $skill_index => $overview) {

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
         * ------------------------------------------------------
         * Individual Skill Box
         * ------------------------------------------------------
         */

        $html .= '

        <section style="
            padding: 15px 10px;
            page-break-inside: avoid;
        ">

            <table style="
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #002060;
            ">

                <colgroup>
                    <col style="width: 40%">
                    <col style="width: 10%">
                    <col style="width: 50%">
                </colgroup>


                <!-- SKILL TITLE -->
                <tr style="background-color: #ffc000;">

                    <td colspan="3"
                        style="
                            padding: 12px 5px;
                            color: #002060;
                            text-transform: uppercase;
                            border: 1px solid #002060;
                        ">
                        PLAN '.$skill_number.'
                    </td>

                </tr>


                <!-- DEVELOPMENT AREA 1 -->
                <tr>

                    <td style="
                        padding: 10px 5px;
                        text-transform: uppercase;                        
                       
                    ">
                        DEVELOPMENT AREA 1
                    </td>

                    <td style="
                        padding: 10px 5px;
                        text-align: center;
                       
                    ">
                    </td>

                    <td style="
                        padding: 10px 5px;
                       
                    ">
                        '.$development_area_1.'
                    </td>

                </tr>


                <!-- DEVELOPMENT AREA 2 -->
                <tr>

                    <td style="
                        padding: 10px 5px;
                        text-transform: uppercase;                       
                       
                    ">
                        DEVELOPMENT AREA 2
                    </td>

                    <td style="
                        padding: 10px 5px;
                        text-align: center;
                       
                    ">
                    </td>

                    <td style="
                        padding: 10px 5px;
                       
                    ">
                        '.$development_area_2.'
                    </td>

                </tr>


                <!-- INDIVIDUAL DEVELOPMENT PLAN TITLE -->
                <tr style="background-color: #ffc000;">

                    <td colspan="3"
                        style="
                            padding: 10px 5px;
                            text-transform: uppercase;                            
                            color: #002060;
                            
                        ">
                        INDIVIDUAL DEVELOPMENT PLAN
                    </td>

                </tr>


                <!-- INDIVIDUAL DEVELOPMENT PLAN CONTENT -->
                <tr>

                    <td colspan="3"
                        style="
                            padding: 10px 5px;
                          
                            vertical-align: top;
                        ">
                        '.$individual_development_plan.'
                    </td>

                </tr>


                <!-- REMARK TITLE -->
                <tr style="background-color: #ffc000;">

                    <td colspan="3"
                        style="
                            padding: 10px 5px;
                            text-transform: uppercase;                            
                            color: #002060;
                            
                        ">
                        REMARK
                    </td>

                </tr>


                <!-- REMARK PLAN CONTENT -->
                <tr>

                    <td colspan="3"
                        style="
                            padding: 10px 5px;
                          
                            vertical-align: top;
                        ">
                        '.$remark.'
                    </td>

                </tr>

            </table>

        </section>';

    }

} else {

    /*
     * No records
     */

    $html .= '

    <section style="padding: 15px 10px;">

        <div style="
            padding: 15px;
            text-align: center;
            border: 1px solid #cccccc;
        ">
            No development plan records found.
        </div>

    </section>';

}


/*
 * ==========================================================
 * FOOTER
 * ==========================================================
 */

$footer .= '<section>

    <div style="
        text-align: center;
        background-color: #002060;
        color: #FFF;
        padding: 20px 0;
        font-weight: 500;
        font-size: 26px;
    ">
        Thank You
    </div>

    <div style="
        padding: 20px 20px;
        text-align: center;
    ">
        <h3>ALCHEMY INTERNATIONAL FOOTBALL ACADEMY - OFFICIAL VILLARREAL ACADEMY</h3>
        <h3>080-49202025</h3>
    </div>

</section>';


$html .= '';


/*
 * ==========================================================
 * DEBUG
 * ==========================================================
 */

print_r($html);
?>