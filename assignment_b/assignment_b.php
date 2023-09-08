<?php

// obtained from  https://github.com/dwyl/english-words/blob/master/words_alpha.txt
$wordsFile = 'words_alpha.txt';
$wordsArray = file($wordsFile, FILE_IGNORE_NEW_LINES);

// run statistics program
wordStatisticProgram($wordsArray); 

function averageArrayVals($arr) {
    $arrLength = count($arr);
    if($arrLength == 0) {
        return null;
    }
    else  {
        $sum = 0;
        foreach ($arr as $val) {
            $sum += $val;
        }
        $avg = $sum / $arrLength;
        return round($avg, 2);
    }
}

function wordStatisticProgram($wordList) {   
     
    $alphabetMap = [];
    foreach (range('a', 'z') as $letter) {
    
        $numOfWordsThatBeginWith = 0;
        $numOfWordsThatEndWith = 0;
        $largestStringLength = [0, ''];
        $shortestStringLength = [PHP_INT_MAX, ''];
        $avgNumOfCharsArr = [];
        foreach ($wordList as $word) {
            $firstLetter = substr($word, 0, 1);
            if($firstLetter == $letter) {
                // num of words that starts with letter 
                $numOfWordsThatBeginWith++;
                $currentStringLength = strlen($word);
                //push num of chars for each word
                $avgNumOfCharsArr[] = $currentStringLength;
                //longest word length that begins what that letter
                if($currentStringLength > $largestStringLength[0]) {
                    $largestStringLength = [$currentStringLength, $word];
                    }
                //shortest word length that begins with that letter
                if($currentStringLength < $shortestStringLength[0]) {
                    $shortestStringLength = [$currentStringLength, $word];
                    }
            }
            //num of words that ends with letter
            $lastLetter = substr($word, -1);
            if($lastLetter == $letter) {
                $numOfWordsThatEndWith++;
            }
        }

        $formattedNumOfBeginWith = number_format($numOfWordsThatBeginWith);
        $beginsWithText = "$formattedNumOfBeginWith words begin with the letter '$letter'";
        $formattedNumOfEndWith = number_format($numOfWordsThatEndWith);
        $endsWithText = "$formattedNumOfEndWith words end with the letter '$letter'";
        $shortestString = $shortestStringLength[1];
        $longestString =  $largestStringLength[1];
        $shortestWordText = ($shortestString) ? "The shortest word that begins with '$letter' is '$shortestString'" : "The shortest word that begins with '$letter' does not exist";
        $longestWordText = $longestString ? "The longest word that begins with '$letter' is '$longestString'": "The longest word that begins with '$letter' does not exist";
        $avgNumOfChars = averageArrayVals($avgNumOfCharsArr);
        $avgNumOfCharsText = ($avgNumOfChars) ? "The average number of characters in words that begin with '$letter' is $avgNumOfChars": "There are no words that begin with the letter '$letter'";

        // create text arrays for each letter
        $alphabetMap[$letter] = ["for '$letter':", $beginsWithText, $endsWithText,  $shortestWordText, $longestWordText, $avgNumOfCharsText];
 }
 
 //print statistics program
    foreach ($alphabetMap as $a) {
        echo("\n");
        foreach ($a as $textStatements) {
            echo($textStatements . "\n");
        }
    }
}

?>