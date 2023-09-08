<?php
function fizzBuzz($upperLimitNum) {    
    for ($i = 1; $i <= $upperLimitNum; $i++) {
        if($i % 3 == 0 && $i % 5 == 0) {
            echo "FizzBuzz \n";
        } else if ($i % 3 == 0) {
            echo "Fizz \n";
        } else if ($i % 5 == 0) {
        echo "Buzz \n";
        } else {
        echo $i . "\n";
        }
    }
}
//calls the function with the upper limit number of 1000
fizzBuzz(1000); 
?>