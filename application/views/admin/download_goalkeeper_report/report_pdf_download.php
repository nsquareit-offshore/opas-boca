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

        <div style="text-align: center;color: #002060;padding: 15px 41px;font-weight: 500;font-size: 26px;border-bottom: 3px solid #002060;margin: 10px auto;">GOALKEEPER EVALUATION FORM</div>

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
                <td style=" padding: 10px 5px;text-transform: uppercase;">Catching/Handling</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';             
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>
            <tr>
                <td style="padding: 10px 5px;text-transform: uppercase;">- Ground balls(scoop/smother)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["ground_balls"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["ground_balls"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["ground_balls"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["ground_balls"].'</td>' : '';
            $html .='</tr>
            
            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Chest-high balls ("W")</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["chest_high_balls"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["chest_high_balls"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["chest_high_balls"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["chest_high_balls"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Bouncing balls</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["bouncing_balls"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["bouncing_balls"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["bouncing_balls"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["bouncing_balls"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Tipping</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["tipping"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["tipping"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["tipping"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["tipping"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Deflect Ball</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["deflect_ball"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["deflect_ball"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["deflect_ball"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["deflect_ball"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Reaction saves (point blank)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["reaction_saves"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["reaction_saves"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["reaction_saves"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["reaction_saves"].'</td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Diving</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>
            
            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- To the left</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["to_the_left"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["to_the_left"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["to_the_left"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["to_the_left"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- To the right</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["to_the_right"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["to_the_right"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["to_the_right"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["to_the_right"].'</td>' : '';
            $html .='</tr>
            
            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Distribution</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>
            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Feet</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["feet"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["feet"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["feet"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["feet"].'</td>' : '';
            $html .='</tr> 

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Drop kick</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["drop_kick"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["drop_kick"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["drop_kick"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["drop_kick"].'</td>' : '';
            $html .='</tr> 

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Goal kick</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["goal_kick"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[1]["goal_kick"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr1]["goal_kick"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$techical_overview[$dynmic_arr2]["goal_kick"].'</td>' : '';
            $html .='</tr> 


        </tbody>
    </table>
    <p style="font-size: 12px;">*PLAYERS SCORED ON EACH ATTRIBUTE FROM 1 TO 10, WITH 1 BEING THE LOWEST AND 10 BEING THE HIGHEST</p>
    </div>
</section>';


$html .= '<section style="page-break-after:always">
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">TACTICAL OVERVIEW</div>
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
                <td style=" padding: 10px 5px;text-transform: uppercase;">Positioning</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';             
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>
            <tr>
                <td style="padding: 10px 5px;text-transform: uppercase;">- Stance</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["stance"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["stance"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["stance"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["stance"].'</td>' : '';
            $html .='</tr>
            
            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Angle (effectiveness at narrowing)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["angle"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["angle"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["angle"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["angle"].'</td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Defending</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Crossed Ball</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["crossed_ball"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["crossed_ball"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["crossed_ball"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["crossed_ball"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Penalty kick</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["penalty_kick"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["penalty_kick"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["penalty_kick"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["penalty_kick"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Corner kick</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["corner_kick"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["corner_kick"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["corner_kick"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["corner_kick"].'</td>' : '';
            $html .='</tr>           
            
            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Direct/Indirect free kick</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["direct_indirect_free_kick"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["direct_indirect_free_kick"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["direct_indirect_free_kick"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["direct_indirect_free_kick"].'</td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Decision Making</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Anticipation</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["anticipation"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["anticipation"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["anticipation"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["anticipation"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Coming off goal line(timing)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["coming_off_goal_line"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["coming_off_goal_line"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["coming_off_goal_line"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["coming_off_goal_line"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Using the back pass effectively</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["using_the_back_pass_effectively"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["using_the_back_pass_effectively"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["using_the_back_pass_effectively"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["using_the_back_pass_effectively"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Commanding the box</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["commanding_the_box"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["commanding_the_box"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["commanding_the_box"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["commanding_the_box"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Organize defense (ball far from goal)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["organize_defense"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["organize_defense"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["organize_defense"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["organize_defense"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Handling crosses("Keeper"/"away")</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["handling_crosses"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["handling_crosses"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["handling_crosses"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["handling_crosses"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Vision of the field</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["vision_of_the_field"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["vision_of_the_field"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["vision_of_the_field"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["vision_of_the_field"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- Control pace (quick counter/slow)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["control_pace"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["control_pace"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["control_pace"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["control_pace"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;text-transform: uppercase;">- "Set" position at time of shot</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[0]["set_position_at_time_of_shot"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[1]["set_position_at_time_of_shot"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr1]["set_position_at_time_of_shot"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$tactical_overview[$dynmic_arr2]["set_position_at_time_of_shot"].'</td>' : '';
            $html .='</tr>
            
            
        </tbody>
    </table>
    <p style="font-size: 12px;">*PLAYERS SCORED ON EACH ATTRIBUTE FROM 1 TO 10, WITH 1 BEING THE LOWEST AND 10 BEING THE HIGHEST</p>
    </div>
</section>';


$html .= '<section style="page-break-after:always">
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">PHYSICAL OVERVIEW</div>
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
                <td style=" padding: 10px 5px;text-transform: uppercase;">Footwork</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["footwork"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["footwork"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["footwork"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["footwork"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Agility(gracefulness)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["agility"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["agility"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["agility"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["agility"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Explosiveness (quickness)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["explosiveness"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["explosiveness"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["explosiveness"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["explosiveness"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Coordination and body control</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["coordination_and_body_control"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["coordination_and_body_control"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["coordination_and_body_control"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["coordination_and_body_control"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Reflex speed</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[0]["reflex_speed"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[1]["reflex_speed"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr1]["reflex_speed"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$physical_overview[$dynmic_arr2]["reflex_speed"].'</td>' : '';
            $html .='</tr>
            
        </tbody>
    </table>
    <p style="font-size: 12px;">*PLAYERS SCORED ON EACH ATTRIBUTE FROM 1 TO 10, WITH 1 BEING THE LOWEST AND 10 BEING THE HIGHEST</p>
    </div>
</section>';


$html .= '<section>
    <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">PSYCHOLOGICAL OVERVIEW</div>
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
                <td style=" padding: 10px 5px;text-transform: uppercase;">Composure (under pressure)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["composure"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["composure"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["composure"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["composure"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Leadership</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["leadership"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["leadership"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["leadership"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["leadership"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Bravery</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["bravery"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["bravery"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["bravery"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["bravery"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Self-confidence</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["self_confidence"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["self_confidence"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["self_confidence"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["self_confidence"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Game mentality (Football Brain) S/W</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["game_mentality"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["game_mentality"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["game_mentality"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["game_mentality"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Work rate (effort)</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["work_rate"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["work_rate"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["work_rate"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["work_rate"].'</td>' : '';
            $html .='</tr>

            <tr>
                <td style=" padding: 10px 5px;"></td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px;"></td>' : '';
            $html .='</tr>

            <tr style="background-color: #ffc000;">
                <td style=" padding: 10px 5px;text-transform: uppercase;">Communication skills</td>';
                $html .= ($report_type != 2) ? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[0]["communication_skills"].'</td>': '';
                $html .= (($count_q == 2 || $count_q == 4) && $report_type != 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[1]["communication_skills"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr1]["communication_skills"].'</td>' : '';
                $html .= ($count_q == 4 || $report_type == 2)? '<td style="padding: 10px 5px; text-align: center;">'.$psychological_overview[$dynmic_arr2]["communication_skills"].'</td>' : '';
            $html .='</tr>

        </tbody>
    </table>
     <p style="font-size: 12px;">*PLAYERS SCORED ON EACH ATTRIBUTE FROM 1 TO 10, WITH 1 BEING THE LOWEST AND 10 BEING THE HIGHEST</p>
     </div>
</section>';


$footer .= '<section>
        <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">Thank You</div>
        <div style=" padding: 20px 20px; text-align: center;">
        <h3>ALCHEMY INTERNATIONAL FOOTBALL ACADEMY - OFFICIAL VILLARREAL ACADEMY</h3>
        <h3>080-49202025</h3>
        </div>
        </section>';

$html .= '';

//==============================================================

  //print_r($html);
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
             
            }
        

        /* End Attach external PDF*/
$mpdf->AddPage();
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