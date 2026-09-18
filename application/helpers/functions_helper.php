<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    
    // -----------------------------------------------------------------------------
    //check auth
    if (!function_exists('auth_check')) {
        function auth_check()
        {
            // Get a reference to the controller object
            $ci =& get_instance();
            if(!$ci->session->has_userdata('is_admin_login'))
            {
                redirect('admin/auth/login', 'refresh');
            }
        }
    }


    // -----------------------------------------------------------------------------
    // Get General Setting
    if (!function_exists('get_general_settings')) {
        function get_general_settings()
        {
            $ci =& get_instance();
            $ci->load->model('admin/setting_model');
            return $ci->setting_model->get_general_settings();
        }
    }

     // -----------------------------------------------------------------------------
    // Generate Admin Sidebar Sub Menu
    if (!function_exists('get_sidebar_sub_menu')) {
        function get_sidebar_sub_menu($parent_id)
        {
            $ci =& get_instance();
            $ci->db->select('*');
            $ci->db->where('parent',$parent_id);
            $ci->db->order_by('sort_order','asc');
            return $ci->db->get('sub_module')->result_array();
        }
    }


    // -----------------------------------------------------------------------------
    // Generate Admin Sidebar Menu
    if (!function_exists('get_sidebar_menu')) {
        function get_sidebar_menu()
        {
            $ci =& get_instance();
            $ci->db->select('*');
            $ci->db->order_by('sort_order','asc');
            return $ci->db->get('module')->result_array();
        }
    }

    function get_user_name_by_id($id){
         $ci =& get_instance();
        $query = $ci->db->get_where('ci_users', array('user_id' => $id));
        return $result = $query->row_array();
    }

    function get_coach_by_userid($id){
         $ci =& get_instance();
        $query = $ci->db->get_where('ci_coach', array('user_id' => $id));
        return $result = $query->row_array();
    }

    function get_year_name_by_id($id){
       
        $ci =& get_instance();         
        $query = $ci->db->get_where('ci_quarter_years', array('id' => $id));
        return $result = $query->row_array();
    }

    function get_team_names_by_id_array($team_id){
       
        $ci =& get_instance();         

        $ci->db->select('
                    id,
                    team_name,
                    team_program,
                    age_cat,
                    location,
                    '
            );
            $ci->db->from('ci_team');
            $ci->db->where('find_in_set(id, "'.$team_id.'")');
            // $ci->db->where('id', $id);
            $query = $ci->db->get();                   
            //return $ci->db->last_query();
            return $query->result_array();

    }

    function get_quarter_data($id,$year_id){
         $ci =& get_instance();
        

        $ci->db->select('
                    ci_forms.id,
                    ci_key_performance.name,
                    ci_forms.key_performance_indicator
                    '
            );
            $ci->db->from('ci_key_performance');

            $ci->db->join('ci_forms', 'ci_forms.key_performance_indicator = ci_key_performance.id ', 'Left');
            $ci->db->order_by('ci_key_performance.id','ASC');
            $ci->db->where('ci_forms.is_active' , 1);
            $ci->db->where('ci_forms.athlete_id' , $id);
            $ci->db->where('ci_forms.quarter_year_id' , $year_id);
            $query = $ci->db->get();                   
             $data_key_per = $query->result_array();

            $count_qt_rep = 1;
            $first_half = 0;
            $second_half = 0;
            $yearly = 0;
            foreach ($data_key_per as $key => $value_per) {

                if($value_per['key_performance_indicator'] == 1 || $value_per['key_performance_indicator'] == 2){
                    //$first_half++;  
                    $yearly++;      
                    $id_qt_f[] = $value_per['id'];
                    $id_qt_y[] = $value_per['id'];

                }

                if($value_per['key_performance_indicator'] == 3 || $value_per['key_performance_indicator'] == 4){
                    //$second_half++; 
                    $yearly++;
                    $id_qt_s[] = $value_per['id'];
                    $id_qt_y[] = $value_per['id'];


                }

                //sprint_r($value_per['id']);
                
                if($first_half == 2){
                    //array_push($data_key_per = ,"blue"=>'Half Yearly Report');
                    $data_key_per[4] = array('id' => (implode(",",$id_qt_f)),'name'=>'First Half Yearly Report','key_performance_indicator'=>"5");
                }

                if($second_half == 2){
                    //array_push($data_key_per = ,"blue"=>'Half Yearly Report');
                    $data_key_per[5] = array('id' => (implode(",",$id_qt_s)),'name'=>'Second Half Yearly Report','key_performance_indicator'=>"6");
                }

                if($yearly == 2){
                    $data_key_per[6] = array('id' => (implode(",",$id_qt_y)),'name'=>'Yearly Report','key_performance_indicator'=>"7");
                }
                $count_qt_rep++;
            }

            // print_r($data_key_per);
            // echo 'aaaa';
            return array_values($data_key_per);
    }


    function get_quarter_data_goalkeeper($id,$year_id){
         $ci =& get_instance();
        //  $ci->db->select('
        //             ci_forms.id,
        //             ci_key_performance.name,
        //             '
        //     );
        // $ci->db->join('ci_key_performance', 'ci_key_performance.id = ci_forms.key_performance_indicator ', 'Left');

        // $query = $ci->db->get_where('ci_forms', array('athlete_id' => $id));
        // return $result = $query->result_array();

        $ci->db->select('
                    ci_goalkeeper_forms.id,
                    ci_key_performance.name,
                    ci_goalkeeper_forms.key_performance_indicator
                    '
            );
            $ci->db->from('ci_key_performance');

            $ci->db->join('ci_goalkeeper_forms', 'ci_goalkeeper_forms.key_performance_indicator = ci_key_performance.id ', 'Left');
            $ci->db->order_by('ci_key_performance.id','ASC');
            $ci->db->where('ci_goalkeeper_forms.is_active' , 1);
            $ci->db->where('ci_goalkeeper_forms.athlete_id' , $id);
            $ci->db->where('ci_goalkeeper_forms.quarter_year_id' , $year_id);
            $query = $ci->db->get();                   
             $data_key_per = $query->result_array();

            $count_qt_rep = 1;
            $first_half = 0;
            $second_half = 0;
            $yearly = 0;
            foreach ($data_key_per as $key => $value_per) {

                if($value_per['key_performance_indicator'] == 1 || $value_per['key_performance_indicator'] == 2){
                    //$first_half++;  
                    $yearly++;      
                    $id_qt_f[] = $value_per['id'];
                    $id_qt_y[] = $value_per['id'];

                }

                if($value_per['key_performance_indicator'] == 3 || $value_per['key_performance_indicator'] == 4){
                    //$second_half++; 
                    $yearly++;
                    $id_qt_s[] = $value_per['id'];
                    $id_qt_y[] = $value_per['id'];


                }

                //sprint_r($value_per['id']);
                
                if($first_half == 2){
                    //array_push($data_key_per = ,"blue"=>'Half Yearly Report');
                    $data_key_per[4] = array('id' => (implode(",",$id_qt_f)),'name'=>'First Half Yearly Report','key_performance_indicator'=>"5");
                }

                if($second_half == 2){
                    //array_push($data_key_per = ,"blue"=>'Half Yearly Report');
                    $data_key_per[5] = array('id' => (implode(",",$id_qt_s)),'name'=>'Second Half Yearly Report','key_performance_indicator'=>"6");
                }

                if($yearly == 2){
                    $data_key_per[6] = array('id' => (implode(",",$id_qt_y)),'name'=>'Yearly Report','key_performance_indicator'=>"7");
                }
                $count_qt_rep++;
            }

            // print_r($data_key_per);
            // echo 'aaaa';
            return array_values($data_key_per);
    }

    function get_quarter_data_academic($id,$year_id){
         $ci =& get_instance();
        
            $ci->db->select('
                    ci_academic_forms.id,
                    ci_academic_forms.quarter_year_id,
                    
                    '
            );
            $ci->db->from('ci_academic_forms');           
            $ci->db->where('ci_academic_forms.is_active' , 1);
            $ci->db->where('ci_academic_forms.athlete_id' , $id);
            $ci->db->where('ci_academic_forms.quarter_year_id' , $year_id);
            $query = $ci->db->get();                   
            return $query->result_array();

       
            // $count_qt_rep = 1;
            // $first_half = 0;
            // $second_half = 0;
            // $yearly = 0;
            // foreach ($data_key_per as $key => $value_per) {

            //     if($value_per['key_performance_indicator'] == 1 || $value_per['key_performance_indicator'] == 2){
            //         //$first_half++;  
            //         $yearly++;      
            //         $id_qt_f[] = $value_per['id'];
            //         $id_qt_y[] = $value_per['id'];

            //     }

            //     if($value_per['key_performance_indicator'] == 3 || $value_per['key_performance_indicator'] == 4){
            //         //$second_half++; 
            //         $yearly++;
            //         $id_qt_s[] = $value_per['id'];
            //         $id_qt_y[] = $value_per['id'];


            //     }

            //     //sprint_r($value_per['id']);
                
            //     if($first_half == 2){
            //         //array_push($data_key_per = ,"blue"=>'Half Yearly Report');
            //         $data_key_per[4] = array('id' => (implode(",",$id_qt_f)),'name'=>'First Half Yearly Report','key_performance_indicator'=>"5");
            //     }

            //     if($second_half == 2){
            //         //array_push($data_key_per = ,"blue"=>'Half Yearly Report');
            //         $data_key_per[5] = array('id' => (implode(",",$id_qt_s)),'name'=>'Second Half Yearly Report','key_performance_indicator'=>"6");
            //     }

            //     if($yearly == 2){
            //         $data_key_per[6] = array('id' => (implode(",",$id_qt_y)),'name'=>'Yearly Report','key_performance_indicator'=>"7");
            //     }
            //     $count_qt_rep++;
            // }

            // print_r($data_key_per);
            // echo 'aaaa';
            //return array_values($data_key_per);
    }
     // -----------------------------------------------------------------------------
    // Make Slug Function    
    if (!function_exists('make_slug'))
    {
        function make_slug($string)
        {
            $lower_case_string = strtolower($string);
            $string1 = preg_replace('/[^a-zA-Z0-9 ]/s', '', $lower_case_string);
            return strtolower(preg_replace('/\s+/', '-', $string1));        
        }
    }

    function pdf_report_sent($data){

            $count_q = $data['count_q'];
            $techical_overview = $data['techical_overview'];
            $tactical_overview = $data['tactical_overview'];
            $staff_notes_overview = $data['staff_notes_overview'];
            $physical_overview = $data['physical_overview'];
            $psychological_overview= $data['psychological_overview'];
            $functional_overview = $data['functional_overview'];
            $body_overview = $data['body_overview'];
            $boday_overview = $data['boday_overview'];
            $report_name = $data['report_name'];
            $default_q_name = $data['d_default_q_name'];
            $report_type = $data['report_type'];
            $report_heading = $data['report_heading'];
            $athlete_name = $data['athlete_name'];
            $athlete_playing_position = $data['athlete_playing_position'];
            $athlete_age_Category = $data['athlete_age_Category'];
            $residence_notes_overview = $data['residence_notes_overview'];

            $d_none_row = 'style="padding: 10px 5px;display: none;"';
            $b_none_row = "style='padding: 10px 5px;display: table-cell;'";


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
                    <td style="padding: 10px 5px;">'.$boday_overview[0]["boday_height_range"].'</td>
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
                    <td style="padding: 10px 5px;">'.$boday_overview[0]["boday_weight_range"].'</td>
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

$footer .= '<section style="page-break-after:always">
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

 //print_r($residence_notes_overview);
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

$content = $mpdf->Output($filename.'.pdf','S');

$fromMail = 'info@bocajuniorsindia.com';
$fromName = 'Boca';
$subject = $data['report_subject'];


//$check = send_email('webcoder.nsquareit@gmail.com', 'Msg send Test', $data['report_name'], '', 'webcoder.nsqua12reit@gmail.com'); 

$ci =& get_instance();

$ci->load->library('email');
$ci->email->clear(TRUE);
$ci->email->set_mailtype("html");
$ci->email->set_newline("\r\n");
$ci->email->from($fromMail, $fromName);
$ci->email->to($data['email_id']);
//$ci->email->to('webcoder.nsquareit@gmail.com');
$ci->email->subject($subject);
$ci->email->message($data['report_name']);
$ci->email->attach($content, 'attachment', $filename, 'application/pdf');
$ci->email->send();

return true;
    }

//------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------
function pdf_report_sent_goalkeeper($data){

            $count_q = $data['count_q'];
            $techical_overview = $data['techical_overview'];
            $tactical_overview = $data['tactical_overview'];
            
            $physical_overview = $data['physical_overview'];
            $psychological_overview= $data['psychological_overview'];
            
            $report_name = $data['report_name'];
            $default_q_name = $data['d_default_q_name'];
            $report_type = $data['report_type'];
            $report_heading = $data['report_heading'];
            $athlete_name = $data['athlete_name'];
            $athlete_playing_position = $data['athlete_playing_position'];
            $athlete_age_Category = $data['athlete_age_Category'];
           

            $d_none_row = 'style="padding: 10px 5px;display: none;"';
            $b_none_row = "style='padding: 10px 5px;display: table-cell;'";


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

        <div style="padding: 20px 60px">
            <div style="text-align: left;color: #002060;padding: 15px 0;font-weight: 500;font-size: 26px;border-bottom: 3px solid #002060;margin: 10px auto;">ATHLETE AGE GROUP</div>
            <div style="text-align: left;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;margin: 10px auto;">'.$athlete_age_Category.'</div>
        </div>

        <div style="padding: 20px 60px">
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
        <p style="font-size: 12px;">A score of 1 means the player can achieve the task 100% of the time a 10 out of 10.</p>
        <p style="font-size: 12px;">A score of 2 means the player can achieve the task 70% of the time a 7 out of 10.</p>
        <p style="font-size: 12px;">A score of 3 means the player can achieve the task 50% of the time a 5 out of 10.</p>
        <p style="font-size: 12px;">A score of 4 means the player can achieve the task 30% of the time a 3 out of 10.</p>
        <p style="font-size: 12px;">A score of 5 means the player can achieve the task only 20% of the time 2 out of 10.</p>
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
        <p style="font-size: 12px;">A score of 1 means the player can achieve the task 100% of the time a 10 out of 10.</p>
        <p style="font-size: 12px;">A score of 2 means the player can achieve the task 70% of the time a 7 out of 10.</p>
        <p style="font-size: 12px;">A score of 3 means the player can achieve the task 50% of the time a 5 out of 10.</p>
        <p style="font-size: 12px;">A score of 4 means the player can achieve the task 30% of the time a 3 out of 10.</p>
        <p style="font-size: 12px;">A score of 5 means the player can achieve the task only 20% of the time 2 out of 10.</p>
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
        <p style="font-size: 12px;">A score of 1 means the player can achieve the task 100% of the time a 10 out of 10.</p>
        <p style="font-size: 12px;">A score of 2 means the player can achieve the task 70% of the time a 7 out of 10.</p>
        <p style="font-size: 12px;">A score of 3 means the player can achieve the task 50% of the time a 5 out of 10.</p>
        <p style="font-size: 12px;">A score of 4 means the player can achieve the task 30% of the time a 3 out of 10.</p>
        <p style="font-size: 12px;">A score of 5 means the player can achieve the task only 20% of the time 2 out of 10.</p>
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
         <p style="font-size: 12px;">A score of 1 means the player can achieve the task 100% of the time a 10 out of 10.</p>
        <p style="font-size: 12px;">A score of 2 means the player can achieve the task 70% of the time a 7 out of 10.</p>
        <p style="font-size: 12px;">A score of 3 means the player can achieve the task 50% of the time a 5 out of 10.</p>
        <p style="font-size: 12px;">A score of 4 means the player can achieve the task 30% of the time a 3 out of 10.</p>
        <p style="font-size: 12px;">A score of 5 means the player can achieve the task only 20% of the time 2 out of 10.</p>
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

    $filename = $report_name;

    $mpdf = new \Mpdf\Mpdf();

    $mpdf->SetDisplayMode('fullpage');

    $mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list


    // LOAD a stylesheet
    $stylesheet = file_get_contents(base_url('assets/dist/css/mpdfstyletables.css'));
    $mpdf->WriteHTML($stylesheet,1);    // The parameter 1 tells that this is css/style only and no body/html/text

    $mpdf->WriteHTML($html,2);
            
           
    $mpdf->AddPage();
    $mpdf->WriteHTML($footer,2);

    $content = $mpdf->Output($filename.'.pdf','S');

    $fromMail = 'info@bocajuniorsindia.com';
    $fromName = 'Boca';
    $subject = $data['report_subject'];


    //$check = send_email('webcoder.nsquareit@gmail.com', 'Msg send Test', $data['report_name'], '', 'webcoder.nsqua12reit@gmail.com'); 

    $ci =& get_instance();

    $ci->load->library('email');
    $ci->email->clear(TRUE);
    $ci->email->set_mailtype("html");
    $ci->email->set_newline("\r\n");
    $ci->email->from($fromMail, $fromName);
    $ci->email->to($data['email_id']);
    //$ci->email->to('webcoder.nsquareit@gmail.com');
    $ci->email->subject($subject);
    $ci->email->message($data['report_name']);
    $ci->email->attach($content, 'attachment', $filename, 'application/pdf');
    $ci->email->send();

    return true;
}  

//------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------
function pdf_report_sent_academic($data){

            $count_q = $data['count_q'];
            $techical_overview = $data['techical_overview'];
            
            $report_name = $data['report_name'];
            $default_q_name = $data['d_default_q_name'];
            $report_type = $data['report_type'];
            $report_heading = $data['report_heading'];
            $athlete_name = $data['athlete_name'];
            $athlete_playing_position = $data['athlete_playing_position'];
            $athlete_age_Category = $data['athlete_age_Category'];
            $team_name = $data['team_name'];
           

            $d_none_row = 'style="padding: 10px 5px;display: none;"';
            $b_none_row = "style='padding: 10px 5px;display: table-cell;'";


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
    $html = '<section style="">
        
        <div style="padding: 10px 60px 0px 60px">
            <div style="text-align: center;padding: 15px 0;font-weight: 500;font-size: 20px;margin: 10px auto;background: #002060;color: white;">ALCHEMY INTERNATIONAL FOOTBALL ACADEMY - OFFICIAL VILLARREAL ACADEMY</div>
        </div>

        <div style="padding: 0px 60px 0px 60px">
            <div style="text-align: left;padding: 15px 18px;font-weight: 500;font-size: 14px;margin: 10px auto;background: #002060;color: white;">'.$report_heading.'</div>
        </div>

        <div style="padding: 0px 60px">
            <div style="text-align: left;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;border-bottom: 3px solid #002060;margin: 10px auto;">NAME</div>
            <div style="text-align: left;color: #002060;padding: 15px 0;font-weight: 500;font-size: 18px;margin: 10px auto;">'.$athlete_name.'</div>
        </div>

        <div style="padding: 0px 60px">
            <div style="text-align: left;color: #002060;padding: 15px 0;font-weight: 500;font-size: 20px;border-bottom: 3px solid #002060;margin: 10px auto;">CENTRE</div>
            <div style="text-align: left;color: #002060;padding: 15px 0;font-weight: 500;font-size: 18px;margin: 10px auto;">'.implode(",", array_column($team_name, "team_name")).'</div>
        </div>

    </section>';


    $html .= '<section style="page-break-after:always">
        
        <div style=" padding: 0px 52px">
        <table style="width: 100%;">
        
        <colgroup>
         <col style="width: 40%">
         <col style="width: 10%">
         <col style="width: 50%">                               
        </colgroup>

            <tbody>
                

                <tr style="background-color: #ffc000;">
                    <td style=" padding: 10px 5px;text-transform: uppercase;">TECHNICAL SKILL</td>
                    <td style="padding: 10px 5px;"></td>
                    <td style="padding: 10px 5px;">COMMENTS</td>';
                   
                $html .='</tr>
                <tr>
                    <td style="padding: 10px 5px;text-transform: uppercase;">Ball manipulation</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["ball_manipulation"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["ball_manipulation_cmt"].'</td>
                    ';
                    
                $html .='</tr>
                
                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Receiving and ball control</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["receiving_and_ball_control"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["receiving_and_ball_control_cmt"].'</td>
                    ';
                    
                $html .='</tr>

                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Quality of First Touch</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["quality_of_first_touch"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["quality_of_first_touch_cmt"].'</td>
                    ';
                   
                $html .='</tr>

                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Turning with the ball</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["turning_with_the_ball"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["turning_with_the_ball_cmt"].'</td>
                    ';
                    
                $html .='</tr>

                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Passing short range</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["passing_short_range"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["passing_short_range_cmt"].'</td>
                    ';
                   
                $html .='</tr>

                
                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Passing long range</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["passing_long_range"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["passing_long_range_cmt"].'</td>
                    ';
                    
                $html .='</tr>

                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Running with the ball</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["running_with_the_ball"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["running_with_the_ball_cmt"].'</td>
                    ';
                    
                $html .='</tr>
                
                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Dribbling technique</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["dribbling_technique"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["dribbling_technique_cmt"].'</td>
                    ';
                    
                $html .='</tr> 

                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Shooting</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["shooting"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["shooting_cmt"].'</td>
                    ';
                   
                $html .='</tr> 

                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Heading</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["heading"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["heading_cmt"].'</td>
                    ';
                    
                $html .='</tr> 

                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Tackling</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["tackling"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["tackling_cmt"].'</td>
                    ';
                    
                $html .='</tr> 

                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Agility, Balance, Co-ordination</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["agility_balance_coordination"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["agility_balance_coordination_cmt"].'</td>
                    ';
                   
                $html .='</tr> 

                <tr>
                    <td style=" padding: 10px 5px;text-transform: uppercase;">Speed</td>
                    <td style="padding: 10px 5px; text-align: center;">'.$techical_overview[0]["speed"].'</td>
                    <td style="padding: 10px 5px;">'.$techical_overview[0]["speed_cmt"].'</td>
                    ';
                   
                $html .='</tr> 


            </tbody>
        </table>
        <p style="font-size: 15px;text-align: center;font-weight: 600;">1=Excellent  2=Good  3=Satisfactory  4=Area for improvement</p>
       
        </div>
    </section>';

    $html .= '<section style="">
        
        <div style=" padding: 30px 52px">
        <table style="width: 100%;">
        
        <colgroup>
         <col style="width: 40%">
         <col style="width: 10%">
         <col style="width: 50%">                               
        </colgroup>

            <tbody>
                

                <tr style="background-color: #ffc000;">
                    <td style=" padding: 10px 5px;text-transform: uppercase;">FURTHER COMMENTS</td>
                  ';
                   
                $html .='</tr>
                <tr>
                    <td style="padding: 10px 5px;text-transform: uppercase;">'.$techical_overview[0]["further_cmt"].'</td>
                    ';
                    
                $html .='</tr>
                
               


            </tbody>
        </table>
       
       
        </div>
    </section>
    ';


    $footer .= '<section>
        <div style="text-align: center;background-color: #002060;color: #FFF;padding: 20px 0;font-weight: 500;font-size: 26px;">Thank You</div>
        <div style=" padding: 20px 20px; text-align: center;">
        <h3>ALCHEMY INTERNATIONAL FOOTBALL ACADEMY - OFFICIAL VILLARREAL ACADEMY</h3>
        <h3>080-49202025</h3>
        </div>
        </section>';

    $html .= '';

    $filename = $report_name;

    $mpdf = new \Mpdf\Mpdf();

    $mpdf->SetDisplayMode('fullpage');

    $mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list


    // LOAD a stylesheet
    $stylesheet = file_get_contents(base_url('assets/dist/css/mpdfstyletables.css'));
    $mpdf->WriteHTML($stylesheet,1);    // The parameter 1 tells that this is css/style only and no body/html/text

    $mpdf->WriteHTML($html,2);
            
           
    // $mpdf->AddPage();
    $mpdf->WriteHTML($footer,2);

    $content = $mpdf->Output($filename.'.pdf','S');

    $fromMail = 'info@bocajuniorsindia.com';
    $fromName = 'Boca';
    $subject = $data['report_subject'];


    //$check = send_email('webcoder.nsquareit@gmail.com', 'Msg send Test', $data['report_name'], '', 'webcoder.nsqua12reit@gmail.com'); 

    $ci =& get_instance();

    $ci->load->library('email');
    $ci->email->clear(TRUE);
    $ci->email->set_mailtype("html");
    $ci->email->set_newline("\r\n");
    $ci->email->from($fromMail, $fromName);
    $ci->email->to($data['email_id']);
   // $ci->email->to('webcoder.nsquareit@gmail.com');
    $ci->email->subject($subject);
    $ci->email->message($data['report_name']);
    $ci->email->attach($content, 'attachment', $filename, 'application/pdf');
    $ci->email->send();

    return true;
}    
    // -----------------------------------------------------------------------------
    //get recaptcha
    if (!function_exists('generate_recaptcha')) {
        function generate_recaptcha()
        {
            $ci =& get_instance();
            if ($ci->recaptcha_status) {
                $ci->load->library('recaptcha');
                echo '<div class="form-group mt-2">';
                echo $ci->recaptcha->getWidget();
                echo $ci->recaptcha->getScriptTag();
                echo ' </div>';
            }
        }
    }

    if (!function_exists('email_report_sent_count')) {
        function email_report_sent_count($data){
            $ci =& get_instance();

            $ci->db->insert('ci_send_email_count', $data);
            return $ci->db->insert_id();
        }
    }
    

    // ----------------------------------------------------------------------------
    //print old form data
    if (!function_exists('old')) {
        function old($field)
        {
            $ci =& get_instance();
            return html_escape($ci->session->flashdata('form_data')[$field]);
        }
    }

    // --------------------------------------------------------------------------------
    if (!function_exists('date_time')) {
        function date_time($datetime) 
        {
           return date('F j, Y',strtotime($datetime));
        }
    }

    // --------------------------------------------------------------------------------
    // limit the no of characters
    if (!function_exists('text_limit')) {
        function text_limit($x, $length)
        {
          if(strlen($x)<=$length)
          {
            echo $x;
          }
          else
          {
            $y=substr($x,0,$length) . '...';
            echo $y;
          }
        }
    }

?>