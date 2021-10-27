<?php 

function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 240 ) { return 'dinliyor &nbsp; <span class="indicator online"></span>'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'yıl',
                30 * 24 * 60 * 60       =>  'ay',
                24 * 60 * 60            =>  'gün',
                60 * 60                 =>  'saat',
                60                      =>  'dakika',
                1                       =>  'saniye'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return ' ' . $t . ' ' . $str . ( $t > 1 ? '' : '' ) . ' önce';
        }
    }
}

?>