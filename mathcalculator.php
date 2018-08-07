<?php
function calculate_median($arr) {
    sort($arr);
    $count = count($arr); //total numbers in array
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
        $median = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median = (($low+$high)/2);
    }
    return $median;
}

function calculate_average($arr) {
    $count = count($arr); //total numbers in array
	$total = 0;
    foreach ($arr as $value) {
        $total = $total + $value; // total value of array numbers
    }
    $average = ($total/$count); // get average value
    return $average;
}

$home_values_array = array("100000", "120000", "150000", "157000", "180000", "198000", "220000", "1450000");

$median_home_value = calculate_median($home_values_array);
echo '<p>Median home value: $'.number_format($median_home_value).'<br />';
$average_home_value = calculate_average($home_values_array);
echo 'Average home value: $'.number_format($average_home_value).'</p>';



echo"<table>";
$inputId = 1;
for ($t=1;$t<4;$t++){
    echo"<tr>";
    for($y=1;$y<4;$y++){
        echo"<td><input id='$inputId' secondaryId='$y'></td>";
        $inputId++;
    }
    echo"</tr>";
}
echo"</table>";


?>