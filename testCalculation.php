function testCalculation()
{
    $date1 = '2020-02-02';
    $date2 = '2023-01-03';

    $com_date = ['2020-01-06','2021-02-06','2022-03-06'];
    $exp_date = ['2021-02-06','2022-03-06','2025-05-06'];
    $guar_fee = ['4000','3000','2000'];


    // find difference month
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

    echo 'Perbezaan bulan sebanyak '.$diff.' bulan.';
    echo '<br>';echo '<br>';
    $jumlah_perlu_dibayar = [];
    for($i=0;$i<$diff;$i++){
        
        $time = strtotime($date1);
        $day = 1;
        $month = date('m',$time);
        $year = date('Y',$time);


        $lastdate = strtotime(date("Y-m-t", $time ));
        //echo $day.$month.$year;
        $day2 = date("d", $lastdate);

        $difference_day = ($day2 - $day)+1;

        echo 'Rekod Pada 1/'.$month.'/'.$year.' sehingga '.$day2.'/'.$month.'/'.$year;
        echo '<br>';
        echo 'Jumlah hari dalam sebulan '.$difference_day.' hari';
        echo '<br>';
        
        //checking value for payment


        for($x=0;$x<count($com_date);$x++)
        {
            $cd = $com_date[$x];
            $ed = $exp_date[$x];
            $gf = $guar_fee[$x];

            $cd_cond1 = strtotime($cd);
            $ed_cond1 = strtotime($ed);

            if(($time>=$cd_cond1)&&($time<=$ed_cond1)){
                echo 'Value pada tahun ini '.$gf;
                echo '<br>';
                $year = date('Y',$cd_cond1);
                $total_days = $this->cal_days_in_year($year);
                echo 'Jumlah hari pada tahun ini '.$total_days;
                echo '<br>';

                $pay_perday = $total_days/$gf;
                echo 'Jumlah perlu dibayar per hari '.$pay_perday;  
                echo '<br>';

                $pay_per_month = $difference_day*$pay_perday;
                echo 'Jumlah perlu dibayar bulan ini '.$pay_per_month;

                echo '<br><br>';


                array_push($jumlah_perlu_dibayar,$pay_per_month);


            }

        }
        
        echo '<br>';

        $date1 = date("Y-m-d", strtotime("+1 month", $time));
        
    }   
    

    // var_dump($jumlah_perlu_dibayar);

    $result = array_sum($jumlah_perlu_dibayar);

    echo "<br>";
    echo 'Jumlah akhir yang perlu dibayar '.$result;
    echo "<br><br><br>";



}


function cal_days_in_year($year){
    $days=0; 
    for($month=1;$month<=12;$month++){ 
        $days = $days + cal_days_in_month(CAL_GREGORIAN,$month,$year);
     }
    return $days;
}