<?php
	


	function convertDate($date, $format){
		
		$new_date = strtotime($date);
        $new_date = date($format, $new_date);

        
        return $new_date;

	}

	//fungsi untuk menggabungkan tanggal.
	//misal 2 Januari 2017 dan 10 Januari 2017
	//maka menghasilkan 2 - 7 Januari 2017
	function concateDate($date1, $date2){

		$new_date1 = strtotime($date1);
		$new_date2 = strtotime($date2);

		if($new_date1==$new_date2){
			$new_date1 = date('d M Y', $new_date1);
			$new_date2 = date('d M Y', $new_date2);

			$result = $new_date1."";

		}else{
			$day1 = date('d', $new_date1);
			$day2 = date('d', $new_date2);

			$month1 = date('M', $new_date1);
			$month2 = date('M', $new_date2);

			$year1 = date('Y', $new_date1);
			$year2 = date('Y', $new_date2);

			if($year1==$year2){

				if($month1==$month2){

					$result = $day1." - ".$day2." ".$month1." ".$year1;

				}else{

					$result = $day1." ".$month1." - ".$day2." ".$month2." ".$year1;

				}

			}else{

				$result = $day1." ".$month1." ".$year1." - ".$day2." ".$month2." ".$year2;

			}
		
		}

		
		return $result;


	}

?>