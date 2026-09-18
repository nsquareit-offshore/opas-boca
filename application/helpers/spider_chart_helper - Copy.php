<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('spider_chart'))
{
    function spider_chart($cycle1,$cycle2)
    {
        $labels=array(
            'Dribbling',
            'Ball Control',
            'Passing',
            'Shooting',
            'Defending',
            'Tactical'
        );

        $cx=250;
        $cy=250;
        $radius=160;
        $count=count($labels);

        $svg='<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500">';

        for($r=1;$r<=5;$r++)
        {
            $points=array();

            for($i=0;$i<$count;$i++)
            {
                $angle=deg2rad(-90+($i*360/$count));

                $x=$cx+cos($angle)*($radius*$r/5);
                $y=$cy+sin($angle)*($radius*$r/5);

                $points[]=$x.','.$y;
            }

            $svg.='<polygon points="'.implode(' ',$points).'" fill="none" stroke="#CFCFCF" stroke-width="1"/>';

            // Scale Number (1,2,3,4,5)
            $txtY = $cy - ($radius*$r/5);

            $svg .= '
                <text
                    x="'.($cx+8).'"
                    y="'.($txtY+5).'"
                    font-size="12"
                    fill="#666"
                    font-family="Arial">
                    '.$r.'
                </text>';
            }

            // Center 0
            $svg .= '
            <text
                x="'.($cx+8).'"
                y="'.($cy+5).'"
                font-size="12"
                fill="#666"
                font-family="Arial">
                0
            </text>';

        for($i=0;$i<$count;$i++)
        {
            $angle=deg2rad(-90+($i*360/$count));

            $x=$cx+cos($angle)*$radius;
            $y=$cy+sin($angle)*$radius;

            $svg.='<line x1="'.$cx.'" y1="'.$cy.'" x2="'.$x.'" y2="'.$y.'" stroke="#bfbfbf"/>';

            $tx=$cx+cos($angle)*($radius+45);
            $ty=$cy+sin($angle)*($radius+30);

            $svg.='<text
            x="'.$tx.'"
            y="'.$ty.'"
            font-size="14"
            font-family="Arial"
            font-weight="bold"
            fill="#000"
            text-anchor="middle">'.$labels[$i].'</text>';
        }

        $points1=array();

        foreach($cycle1 as $k=>$v)
        {
            $angle=deg2rad(-90+($k*360/$count));

            $x=$cx+cos($angle)*($radius*$v/5);
            $y=$cy+sin($angle)*($radius*$v/5);

            $points1[]=$x.','.$y;
        }

        $svg.='<polygon
            points="'.implode(' ',$points1).'"
            fill="#2196F3"
            fill-opacity="0.35"
            stroke="#2196F3"
            stroke-width="3"
            stroke-opacity="1"
        />';

        foreach($points1 as $p)
        {
            list($x,$y)=explode(',',$p);

            $svg.='<circle cx="'.$x.'" cy="'.$y.'" r="4" fill="#2196F3"/>';
        }

        $points2=array();

        foreach($cycle2 as $k=>$v)
        {
            $angle=deg2rad(-90+($k*360/$count));

            $x=$cx+cos($angle)*($radius*$v/5);
            $y=$cy+sin($angle)*($radius*$v/5);

            $points2[]=$x.','.$y;
        }

        $svg.='<polygon
            points="'.implode(' ',$points2).'"
            fill="#FFA500"
            fill-opacity="0.35"
            stroke="#FFA500"
            stroke-width="3"
            stroke-opacity="1"
        />';

        foreach($points2 as $p)
        {
            list($x,$y)=explode(',',$p);

            $svg.='<circle cx="'.$x.'" cy="'.$y.'" r="4" fill="#FFA500"/>';
        }

        $svg.='</svg>';

        return $svg;
    }
}