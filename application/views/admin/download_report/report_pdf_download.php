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

$html .= '<section style="page-break-after:always">
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">NOTES FROM COACHING STAFF '.$default_q_name.'</div>

    <div style="padding: 10px 60px">
        <div style="text-align: left;color: #002060;padding: 20px 0;font-weight: 500;font-size: 26px;border-bottom: 3px solid #002060;margin: 10px auto;">NOTES FROM TECHNICAL DIRECTOR</div>
        <div style="text-align: justify;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;margin: 10px auto;">'.$staff_notes_overview[0]['notes_frm_tech_dir'].'</div>
    </div>

    <div style="padding: 10px 60px">
        <div style="text-align: left;color: #002060;padding: 20px 0;font-weight: 500;font-size: 26px;border-bottom: 3px solid #002060;margin: 10px auto;">NOTES FROM HEAD COACH</div>
        <div style="text-align: justify;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;margin: 10px auto;">'.$staff_notes_overview[0]['notes_frm_head_coach'].'</div>
    </div>

</section>';

    if($report_type == 3){

    $html .= '<section style="page-break-after:always">
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">NOTES FROM COACHING STAFF CYCLE 2</div>

    <div style="padding: 10px 60px">
        <div style="text-align: left;color: #002060;padding: 20px 0;font-weight: 500;font-size: 26px;border-bottom: 3px solid #002060;margin: 10px auto;">NOTES FROM TECHNICAL DIRECTOR</div>
        <div style="text-align: justify;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;margin: 10px auto;">'.$staff_notes_overview[1]['notes_frm_tech_dir'].'</div>
    </div>

    <div style="padding: 10px 60px">
        <div style="text-align: left;color: #002060;padding: 20px 0;font-weight: 500;font-size: 26px;border-bottom: 3px solid #002060;margin: 10px auto;">NOTES FROM HEAD COACH</div>
        <div style="text-align: justify;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;margin: 10px auto;">'.$staff_notes_overview[1]['notes_frm_head_coach'].'</div>
    </div>

    </section>';
       
    }

$html .= '<section style="page-break-after:always">
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">TECHNICAL OVERVIEW</div>
    <div style=" padding: 20px 20px">
    <table style="width: 100%;">
        <tbody>
            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">KEY PERFORMANCE INDICATOR</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$default_q_name.'</td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">CYCLE 2</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q3</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q4</td>' : '';

            $html .= '</tr>
            <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">DRIBBLING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';             
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>
            <tr>
                <td style=" padding: 10px 5px;">- RUNNING WITH THE BALL</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["running_with_the_ball"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["running_with_the_ball"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["running_with_the_ball"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["running_with_the_ball"].'</td>' : '';
            $html .='</tr>
            
            <tr>
                <td style=" padding: 10px 5px;">- FEINTING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["feinting"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["feinting"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["feinting"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["feinting"].'</td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">BALL CONTROL</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>
            
            <tr>
                <td style=" padding: 10px 5px;">- QUALITY OF FIRST TOUCH</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["quality_of_first_touch"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["quality_of_first_touch"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["quality_of_first_touch"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["quality_of_first_touch"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- RECEIVING UNDER PRESSURE</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["receiving_under_pressure"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["receiving_under_pressure"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["receiving_under_pressure"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["receiving_under_pressure"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- BALL MANIPULATION</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["ball_manipulation"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["ball_manipulation"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["ball_manipulation"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["ball_manipulation"].'</td>' : '';
            $html .='</tr>
            
            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">PASSING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>
            <tr>
                <td style=" padding: 10px 5px;">- SHORT PASSING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["short_passing"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["short_passing"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["short_passing"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["short_passing"].'</td>' : '';
            $html .='</tr> 

            <tr>
                <td style=" padding: 10px 5px;">- LONG PASSING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["long_passing"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["long_passing"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["long_passing"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["long_passing"].'</td>' : '';
            $html .='</tr> 

            <tr>
                <td style=" padding: 10px 5px;">- CROSSING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["crossing"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["crossing"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["crossing"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["crossing"].'</td>' : '';
            $html .='</tr> 

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">SHOOTING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- FINISHING INSIDE THE PENALTY AREA</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["finishing_inside_the_penalty_area"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["finishing_inside_the_penalty_area"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["finishing_inside_the_penalty_area"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["finishing_inside_the_penalty_area"].'</td>' : '';
            $html .='</tr> 

            <tr>
                <td style=" padding: 10px 5px;">- FINISHING OUTSIDE THE PENALTY AREA</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["finishing_outside_the_penalty_area"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["finishing_outside_the_penalty_area"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["finishing_outside_the_penalty_area"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["finishing_outside_the_penalty_area"].'</td>' : '';
            $html .='</tr> 

            <tr>
                <td style=" padding: 10px 5px;">- HEADING AT GOAL</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["heading_at_goal"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["heading_at_goal"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["heading_at_goal"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["heading_at_goal"].'</td>' : '';
            $html .='</tr> 

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">DEFENDING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- TACKLING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["tackling"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["tackling"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["tackling"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["tackling"].'</td>' : '';
            $html .='</tr> 

            <tr>
                <td style=" padding: 10px 5px;">- DEFENSIVE STANCE</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["defensive_stance"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["defensive_stance"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["defensive_stance"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["defensive_stance"].'</td>' : '';
            $html .='</tr> 

            <tr>
                <td style=" padding: 10px 5px;">- DEFENSIVE HEADING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["defensive_heading"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["defensive_heading"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["defensive_heading"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["defensive_heading"].'</td>' : '';
            $html .='</tr> 

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">NON-DOMINANT FOOT ABILITY</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["non_dominant_foot_ability"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["non_dominant_foot_ability"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["non_dominant_foot_ability"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["non_dominant_foot_ability"].'</td>' : '';
            $html .='</tr> 

        </tbody>
    </table>
    <p style="font-size: 12px;">*PLAYERS SCORED ON EACH ATTRIBUTE FROM 1 TO 5, WITH 1 BEING THE LOWEST AND 5 BEING THE HIGHEST</p>
    </div>
</section>';


$html .= '<section style="page-break-after:always">
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">TACTICAL OVERVIEW</div>
    <div style=" padding: 20px 20px">
    <table style="width: 100%;">
        <tbody>
            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">KEY PERFORMANCE INDICATOR</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$default_q_name.'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">CYCLE 2</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q3</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q4</td>' : '';
            $html .='</tr>

            <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">READING OF THE GAME</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["ta_reading_game"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["ta_reading_game"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["ta_reading_game"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["ta_reading_game"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">TEAM PHILOSOPHY</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["team_philosophy"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["team_philosophy"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["team_philosophy"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["team_philosophy"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">ATTACKING PRINCIPLES</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["attacking_principles"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["attacking_principles"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["attacking_principles"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["attacking_principles"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">NEGATIVE TRANSITION PRINCIPLES</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["negative_transition_principles"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["negative_transition_principles"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["negative_transition_principles"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["negative_transition_principles"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">DEFENDING PRINCIPLES</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["defending_principles"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["defending_principles"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["defending_principles"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["defending_principles"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">POSITIVE TRANSITION PRINCIPLES </td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["positive_transition_principles"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["positive_transition_principles"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["positive_transition_principles"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["positive_transition_principles"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">PLAYER POSITION & ROLE</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["player_position_role"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["player_position_role"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["player_position_role"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["player_position_role"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">SET-PIECE STRATEGIES</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["set_piece_strategies"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["set_piece_strategies"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["set_piece_strategies"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["set_piece_strategies"].'</td>' : '';
            $html .='</tr>

        </tbody>
    </table>
    <p style="font-size: 12px;">*PLAYERS SCORED ON EACH ATTRIBUTE FROM 1 TO 5, WITH 1 BEING THE LOWEST AND 5 BEING THE HIGHEST</p>
    </div>
</section>';


$html .= '<section style="page-break-after:always">
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">PHYSICAL OVERVIEW</div>
    <div style=" padding: 20px 20px">
    <table style="width: 100%;">
        <tbody>
            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">KEY PERFORMANCE INDICATOR </td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$default_q_name.'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">CYCLE 2</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q3</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q4</td>' : '';
            $html .='</tr>

            <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">ASSESSMENT WITH THE BALL</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- SPEED 20m.</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["with_speed_20m"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["with_speed_20m"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["with_speed_20m"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["with_speed_20m"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- SPEED 40m.</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["with_speed_40m"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["with_speed_40m"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["with_speed_40m"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["with_speed_40m"].'</td>' : '';
            $html .='</tr>
            <tr>
                <td style=" padding: 10px 5px;">- ARROWHEAD AGILITY (LEFT SIDE)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["with_arrowhead_agility_left_side"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["with_arrowhead_agility_left_side"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["with_arrowhead_agility_left_side"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["with_arrowhead_agility_left_side"].'</td>' : '';
            $html .='</tr>
            <tr>
                <td style=" padding: 10px 5px;">- ARROWHEAD AGILITY (RIGHT SIDE)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["with_arrowhead_agility_right_side"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["with_arrowhead_agility_right_side"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["with_arrowhead_agility_right_side"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["with_arrowhead_agility_right_side"].'</td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">ASSESSMENT WITHOUT THE BALL</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- SPEED 20m.</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["without_speed_20m"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["without_speed_20m"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["without_speed_20m"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["without_speed_20m"].'</td>' : '';
            $html .='</tr>
            <tr>
                <td style=" padding: 10px 5px;">- SPEED 40m.</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["without_speed_40m"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["without_speed_40m"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["without_speed_40m"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["without_speed_40m"].'</td>' : '';
            $html .='</tr>
            <tr>
                <td style=" padding: 10px 5px;">- YO-YO INTERMITTENT RECOVERY TEST</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["yo_yo_intermittent_recovery_test"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["yo_yo_intermittent_recovery_test"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["yo_yo_intermittent_recovery_test"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["yo_yo_intermittent_recovery_test"].'</td>' : '';
            $html .='</tr>
            <tr>
                <td style=" padding: 10px 5px;">- ARROWHEAD AGILITY (LEFT SIDE)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["without_arrowhead_agility_left_side"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["without_arrowhead_agility_left_side"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["without_arrowhead_agility_left_side"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["without_arrowhead_agility_left_side"].'</td>' : '';
            $html .='</tr>
            <tr>
                <td style=" padding: 10px 5px;">- ARROWHEAD AGILITY (RIGHT SIDE)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["without_arrowhead_agility_right_side"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["without_arrowhead_agility_right_side"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["without_arrowhead_agility_right_side"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["without_arrowhead_agility_right_side"].'</td>' : '';
            $html .='</tr>
            <tr>
                <td style=" padding: 10px 5px;">- VERTICAL JUMP</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["vertical_jump"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["vertical_jump"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["vertical_jump"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["vertical_jump"].'</td>' : '';
            $html .='</tr>
        </tbody>
    </table>
    <p style="font-size: 12px;">*PLAYERS PERFORMANCE ON EACH MATRIC IS MEASURED IN SECONDS</p>
    </div>
</section>';


$html .= '<section style="page-break-after:always">
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">PSYCHOLOGICAL OVERVIEW</div>
    <div style=" padding: 20px 20px">
    <table style="width: 100%;">
        <tbody>
            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">KEY PERFORMANCE INDICATOR</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$default_q_name.'</td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;">CYCLE 2</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q3</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q4</td>' : '';
            $html .='</tr>
            <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">DURING TRAINING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">-CONCENTRATION & ATTENTION SPAN</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["training_concentration_attention_span"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["training_concentration_attention_span"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["training_concentration_attention_span"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["training_concentration_attention_span"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- EMOTIONAL CONTROL</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["training_emotional_control"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["training_emotional_control"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["training_emotional_control"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["training_emotional_control"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- SELF-CONFIDENCE</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["training_self_confidence"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["training_self_confidence"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["training_self_confidence"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["training_self_confidence"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- ATTITUDE & WORK ETHIC</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["training_attitude_work_ethic"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["training_attitude_work_ethic"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["training_attitude_work_ethic"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["training_attitude_work_ethic"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- ABILITY TO UNDERSTAND INSTRUCTIONS</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["training_ability_to_understand_instructions"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["training_ability_to_understand_instructions"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["training_ability_to_understand_instructions"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["training_ability_to_understand_instructions"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- CREATIVITY & IMPROVISATION</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["training_creativity_improvisation"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["training_creativity_improvisation"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["training_creativity_improvisation"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["training_creativity_improvisation"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- DECISION-MAKING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["training_decision_making"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["training_decision_making"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["training_decision_making"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["training_decision_making"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- LEADERSHIP & RESPONSIBILITY</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["training_leadership_responsibility"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["training_leadership_responsibility"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["training_leadership_responsibility"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["training_leadership_responsibility"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- TRAINING PREPARATIONS</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["training_preparations"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["training_preparations"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["training_preparations"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["training_preparations"].'</td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">- DURING MATCHES</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';             
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- CONCENTRATION & TASK FOCUS</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["matches_concentration_task_focus"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["matches_concentration_task_focus"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["matches_concentration_task_focus"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["matches_concentration_task_focus"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- EMOTIONAL CONTROL</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["matches_emotional_control"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["matches_emotional_control"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["matches_emotional_control"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["matches_emotional_control"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- SELF-CONFIDENCE</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["matches_self_confidence"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["matches_self_confidence"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["matches_self_confidence"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["matches_self_confidence"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- ATTITUDE & WORK ETHIC</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["matches_attitude_work_ethic"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["matches_attitude_work_ethic"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["matches_attitude_work_ethic"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["matches_attitude_work_ethic"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- ABILITY TO UNDERSTAND INSTRUCTIONS</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["matches_ability_to_understand_instructions"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["matches_ability_to_understand_instructions"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["matches_ability_to_understand_instructions"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["matches_ability_to_understand_instructions"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- CREATIVITY & IMPROVISATION</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["matches_creativity_improvisation"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["matches_creativity_improvisation"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["matches_creativity_improvisation"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["matches_creativity_improvisation"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- DECISION-MAKING</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["matches_decision_making"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["matches_decision_making"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["matches_decision_making"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["matches_decision_making"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- LEADERSHIP & RESPONSIBILITY</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["matches_leadership_responsibility"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["matches_leadership_responsibility"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["matches_leadership_responsibility"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["matches_leadership_responsibility"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;">- MATCH PREPARATION</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["match_preparation"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["match_preparation"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["match_preparation"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["match_preparation"].'</td>' : '';
            $html .='</tr>

        </tbody>
    </table>
     <p style="font-size: 12px;">*PLAYERS SCORED ON EACH ATTRIBUTE RATING FROM 1 TO 5.WITH 1 BEING THE LOWEST & 5 BEING THE HIGHEST</p>
     </div>
</section>';


$html .= '<section style="page-break-after:always">
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">FUNCTIONAL MOVEMENT SCREEN</div>
    <div style=" padding: 20px 20px">
    <table style="width: 100%;">
        <tbody>
            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">KEY PERFORMANCE INDICATOR</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$default_q_name.'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">CYCLE 2</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q3</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q4</td>' : '';
            $html .='</tr>

            <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">DEEP SQUAT</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[0]["deep_squat"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[1]["deep_squat"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr1]["deep_squat"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr2]["deep_squat"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">INLINE LUNGE </td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[0]["inline_lunge"].'</td>': '';
                    $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[1]["inline_lunge"].'</td>' : '';
                    $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr1]["inline_lunge"].'</td>' : '';
                    $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr2]["inline_lunge"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">HURDLE CROSSING </td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[0]["hurdle_crossing"].'</td>': '';
                    $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[1]["hurdle_crossing"].'</td>' : '';
                    $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr1]["hurdle_crossing"].'</td>' : '';
                    $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr2]["hurdle_crossing"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">ACTIVE SINGLE-LEG RAISE</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[0]["active_single_leg_raise"].'</td>': '';
                    $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[1]["active_single_leg_raise"].'</td>' : '';
                    $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr1]["active_single_leg_raise"].'</td>' : '';
                    $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr2]["active_single_leg_raise"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">TRUNK STABILITY PUSH-UPS</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[0]["trunk_stability_push_ups"].'</td>': '';
                    $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[1]["trunk_stability_push_ups"].'</td>' : '';
                    $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr1]["trunk_stability_push_ups"].'</td>' : '';
                    $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr2]["trunk_stability_push_ups"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">ROTATORY STABILITY </td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[0]["rotatory_stability"].'</td>': '';
                    $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[1]["rotatory_stability"].'</td>' : '';
                    $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr1]["rotatory_stability"].'</td>' : '';
                    $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$functional_overview[$dynmic_arr2]["rotatory_stability"].'</td>' : '';
            $html .='</tr>

        </tbody>
    </table>
    <p style="font-size: 12px;">*PLAYERS SCORED ON EACH ATTRIBUTE RATING FROM 1 TO 3.WITH 1 BEING THE LOWEST & 3 BEING THE HIGHEST</p>
    </div>
</section>';

$html .= '<section style="page-break-after:always">
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">BODY COMPOSITION ANALYSIS</div>
        <div style=" padding: 20px 20px">
        <table style="width: 100%;">
            <tbody>
                <tr style="background-color: #ffc000;">
                    <td style=" padding: 10px 5px;">KEY DETAILS </td>';
                    $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;">IDEAL RANGE<br>'.$default_q_name.'</td>' : '';
                    $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$default_q_name.'</td>': '';                   
                    
                    $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;">IDEAL RANGE<br>CYCLE2</td>' : '';
                    $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">CYCLE 2</td>' : '';
                    $html .='</tr>
                
                 <tr>
                <td style="padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
               
                $html .='</tr>';

                
                $html .='
                <tr>
                    <td style=" padding: 10px 5px;">HEIGHT (CM.)</td>
                    <td style="padding: 10px 5px;"> - </td>
                    <td style="padding: 10px 5px;">'.$boday_overview[0]["boday_height_val"].'</td>
                    ';
                    $html .= ($count_q == 2 || $count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[1]["boday_height_range"].'</td>' : '';
                    $html .= ($count_q == 2 || $count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[1]["boday_height_range"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[2]["boday_height_range"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[2]["boday_height_range"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[3]["boday_height_range"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[3]["boday_height_range"].'</td>' : '';
                $html .='</tr>
                
                <tr>
                    <td style=" padding: 10px 5px;">WEIGHT (KG.)</td>
                    <td style="padding: 10px 5px;"> - </td>
                    <td style="padding: 10px 5px;">'.$boday_overview[0]["boday_weight_val"].'</td>';
                    $html .= ($count_q == 2 || $count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[1]["boday_weight_range"].'</td>' : '';
                    $html .= ($count_q == 2 || $count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[1]["boday_weight_val"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[2]["boday_weight_range"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[2]["boday_weight_val"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[3]["boday_weight_range"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[3]["boday_weight_val"].'</td>' : '';
                $html .='</tr>
                </tr>
                <tr>
                    <td style=" padding: 10px 5px;">BMI (BODY MASS INDEX)</td>
                    <td style="padding: 10px 5px;">'.$boday_overview[0]["boday_bmi_range"].'</td>
                    <td style="padding: 10px 5px;">'.$boday_overview[0]["boday_bmi_val"].'</td>';
                    $html .= ($count_q == 2 || $count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[1]["boday_bmi_range"].'</td>' : '';
                    $html .= ($count_q == 2 || $count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[1]["boday_bmi_val"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[2]["boday_bmi_range"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[2]["boday_bmi_val"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[3]["boday_bmi_range"].'</td>' : '';
                    $html .= ($count_q == 4)? '<td style="padding: 10px 5px;">'.$boday_overview[3]["boday_bmi_val"].'</td>' : '';
                $html .='</tr>
                
            </tbody>
        </table>
    </section>';

$footer .= '<section>
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">NOTES FROM RESIDENCE WARDEN</div>
    <div style=" padding: 20px 20px">
    <table style="width: 100%;">
        <tbody>
            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">KEY PERFORMANCE INDICATOR</td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$default_q_name.'</td>': '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">CYCLE 2</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q3</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">Q4</td>' : '';
            $footer .='</tr>

            <tr>
                <td style="padding: 10px 5px;"></td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $footer .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">EDUCATION</td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[0]["notes_frm_resi_war_education"].'</td>': '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[1]["notes_frm_resi_war_education"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr1]["notes_frm_resi_war_education"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr2]["notes_frm_resi_war_education"].'</td>' : '';
            $footer .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $footer .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">DISCIPLINE</td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[0]["notes_frm_resi_war_discipline"].'</td>': '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[1]["notes_frm_resi_war_discipline"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr1]["notes_frm_resi_war_discipline"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr2]["notes_frm_resi_war_discipline"].'</td>' : '';
            $footer .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $footer .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">HYGIENE</td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[0]["notes_frm_resi_war_hygiene"].'</td>': '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[1]["notes_frm_resi_war_hygiene"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr1]["notes_frm_resi_war_hygiene"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr2]["notes_frm_resi_war_hygiene"].'</td>' : '';
            $footer .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $footer .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">TEAMWORK</td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[0]["notes_frm_resi_war_teamwork"].'</td>': '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[1]["notes_frm_resi_war_teamwork"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr1]["notes_frm_resi_war_teamwork"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr2]["notes_frm_resi_war_teamwork"].'</td>' : '';
            $footer .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $footer .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">DIET</td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[0]["notes_frm_resi_war_diet"].'</td>': '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[1]["notes_frm_resi_war_diet"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr1]["notes_frm_resi_war_diet"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr2]["notes_frm_resi_war_diet"].'</td>' : '';
            $footer .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $footer .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;">CONDUCT</td>';
                $footer .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[0]["notes_frm_resi_war_conduct"].'</td>': '';
                $footer .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[1]["notes_frm_resi_war_conduct"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr1]["notes_frm_resi_war_conduct"].'</td>' : '';
                $footer .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$residence_notes_overview[$dynmic_arr2]["notes_frm_resi_war_conduct"].'</td>' : '';
            $footer .='</tr>

        </tbody>
    </table>

     <div style="padding: 0px 20px">
        <div style="text-align: left;color: #002060;padding: 0px 0;font-weight: 500;font-size: 22px;border-bottom: 3px solid #002060;margin: 10px auto;">KEY OBSERVATIONS '.$default_q_name.'</div>
        <div style="text-align: justify;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;margin: 10px auto;">'.$residence_notes_overview[0]["notes_frm_resi_war_key_observ"].'</div>
    </div>';

    if($report_type == 3){
         $footer .= '
         <div style="padding: 0px 20px">
            <div style="text-align: left;color: #002060;padding: 0px 0;font-weight: 500;font-size: 22px;border-bottom: 3px solid #002060;margin: 10px auto;">KEY OBSERVATIONS CYCLE 2</div>
            <div style="text-align: justify;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;margin: 10px auto;">'.$residence_notes_overview[1]["notes_frm_resi_war_key_observ"].'</div>
        </div>';
    }

    $footer .= '
     <p style="font-size: 12px;">*PLAYERS SCORED ON EACH ATTRIBUTE FROM 1 TO 5, WITH 1 BEING THE LOWEST AND 5 BEING THE HIGHEST</p>
     </div>
</section>';

// $footer .= '<section>
//         <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">Thank You</div>
//         <div style=" padding: 20px 20px; text-align: center;">
//         <h3>ALCHEMY INTERNATIONAL FOOTBALL ACADEMY - OFFICIAL VILLARREAL ACADEMY</h3>
//         <h3>080-49202025</h3>
//         </div>
//         </section>';

$html .= '';

//==============================================================

 // print_r($html);
 // print_r($boday_overview[0]['body_composition_pdf']);
 // print_r($boday_overview[1]['body_composition_pdf']);
  //exit;


$filename = $report_name;

$mpdf = new \Mpdf\Mpdf();

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list


// LOAD a stylesheet
$stylesheet = file_get_contents(base_url('assets/dist/css/mpdfstyletables.css'));
$mpdf->WriteHTML($stylesheet,1);    // The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,2);

        
        /* Attach external PDF*/      
        $Mfiles = array();

         //Multiple pdf store in Mfiles array with full path.   
        if(isset($body_overview[0]['body_composition_pdf']) && !empty($body_overview[0]['body_composition_pdf']) && file_exists('./uploads/bodycomposition_pdf/'.$body_overview[0]['body_composition_pdf'])){            
             
             array_push($Mfiles,'./uploads/bodycomposition_pdf/'.$body_overview[0]['body_composition_pdf']);
        }
        
        if(isset($body_overview[1]['body_composition_pdf']) && !empty($body_overview[1]['body_composition_pdf']) && file_exists('./uploads/bodycomposition_pdf/'.$body_overview[1]['body_composition_pdf'])){            
             
             array_push($Mfiles,'./uploads/bodycomposition_pdf/'.$body_overview[1]['body_composition_pdf']);
        }

                        
         

         // after loop we start this code
          if($Mfiles && !empty($Mfiles)) 
            {
              $filesTotal = sizeof($Mfiles);
              $fileNumber = 1;
              
              
              foreach ($Mfiles as $fileName2) 
              {
                if (file_exists($fileName2)) 
                {
                  $pagesInFile = $mpdf->SetSourceFile($fileName2);
                  for ($i = 1; $i <= $pagesInFile; $i++) 
                  {
                    $tplId = $mpdf->importPage($i);
                    $mpdf->UseTemplate($tplId, null, null, 215.6, null,FALSE);
                    if (($fileNumber < $filesTotal) || ($i != $pagesInFile)) 
                    {
                        $mpdf->WriteHTML('<pagebreak />');
                    }
                  }
                }
                $fileNumber++;
              }
             $mpdf->AddPage();
            }
        

        /* End Attach external PDF*/

$mpdf->WriteHTML($footer,2);

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
//  //redirect($redirect_url);
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