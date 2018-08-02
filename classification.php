<style type="text/css">
        body {
  background: #EAEBEC;
  background-size: 100% 100%;

  background-image: url(Mining.jpg);
  background-attachment: fixed;
  background-repeat: no-repeat;
}

.div1 {
             width: 60%;
             font-family: "Andale Mono",monospace;
              margin: 10px auto;
             margin-top: 40px ;


             font-size: 20px;
             border: 1px solid red;
              color: #fff;
             padding: 10px;
             
             border: solid 1px #3A4655;
  box-shadow: 0 8px 50px -7px black;
   background: #3A4655;
         }
      

          .outlier
 {
  border: 1px solid black;
  padding: 12px;
  margin: 12px;
  box-shadow: 0 8px 50px -7px black;
 }
</style>

<div class="div1">
<?php
            ///////////////////////////////////////////

             function k_nearest($record)
    {
        global $TrainingSet;
        $diffrent = array(10, 10, 10); //10 caz i sure that the bigest diffrent 6
        $diffrientPos = array(0, 0, 0);

        for ($j = 0; $j < sizeof($TrainingSet); $j++) {
            $line = explode(",", $TrainingSet[$j]);
            $count = 0;
            for ($i = 0; $i < 6; $i++) {

                if ($record[$i] != $line[$i]) {

                    $count += 1;
                }

            }

            if ($count < $diffrent[0]) {
                $diffrent[0] = $count;
                $diffrientPos[0] = $j;
            }
            elseif($count < $diffrent[1]) {
                $diffrent[1] = $count;
                $diffrientPos[1] = $j;
            }
            elseif($count < $diffrent[2]) {
                $diffrent[2] = $count;
                $diffrientPos[2] = $j;
            }

        }

        //find class label
        $NumofYes = 0;
        $NumofNo = 0;
        for ($i = 0; $i < 3; $i++) {

            $line = explode(",", $TrainingSet[$diffrientPos[$i]]);
            if ($line[6] == "no") {

                $NumofNo++;
            } else {

                $NumofYes++;
            }
        }

        if ($NumofNo > $NumofYes) {
            return "no";
        } else {
            return "yes";
        }

    }
/////////////////////////////////////
//     function findLabel($record
    
//         )
//     {

//         global $TrainingSet, $NumofNo, $NumofYes, $PofYes, $PofNo,$disencedYes,$disencedNo;
//         $PyesArr = array(0, 0, 0, 0, 0, 0);
//         $PnoArr = array(0, 0, 0, 0, 0, 0);

//         for ($j = 0; $j < sizeof($TrainingSet); $j++) {
//             $line = explode(",", $TrainingSet[$j]);
//             for ($i = 0; $i < 6; $i++) {

//                 if ($record[$i] == $line[$i]) {

//                     if ($line[6] == "yes") {
//                         $PyesArr[$i] += 1;
//                     } else {
//                         $PnoArr[$i] += 1;
//                     }

//                 }

//             }

//         }

// ////////////////////////////////////////////////////////////////////////////////
//         $mulYes = 1;
//         $mulNo = 1;
//         for ($i = 0; $i < 6; $i++) {

//             $PyesArr[$i] /= $NumofYes;
//             $PnoArr[$i] /= $NumofNo;

//             $mulYes *= $PyesArr[$i];
//             $mulNo *= $PnoArr[$i];

//         }

//         $labelYes = $mulYes * $PofYes;
//         $labelNo = $mulNo * $PofNo;

//         if ($labelNo > $labelYes) {
//             return "no";
//         } else {
//             return "yes";
//         }

//     }

    ///////////////////////


    function findLabel12($record)
    {
        $mulYes=1;
        $mulNo=1;
    global $TrainingSet, $NumofNo, $NumofYes, $PofYes, $PofNo,$disencedYes,$disencedNo;
    	for ($i = 0; $i < 6; $i++) {
             
            

            $mulYes *= $disencedYes[$i][$record[$i]]/$NumofYes;
            $mulNo *= $disencedNo[$i][$record[$i]]/$NumofNo;

        }

        $labelYes = $mulYes * $PofYes;
        $labelNo = $mulNo * $PofNo;

        if ($labelNo > $labelYes) {
            return "no";
        } else {
            return "yes";
        }
    }
//////////////////////////////////////////////////////////////////

    function ReadFile1($FileName
    
        )
                {

                        $myfile = fopen($FileName, "r") or die
        ("Unable to open file!");

                        $i = 0;
        $bank = array();
        while ($x = fgets($myfile)) {

            $x = substr($x, 0, -2);

            // echo $x."<br>";
            array_push($bank, $x);

        }

        array_pop($bank);

        //read last line caz in last line fgets didnt read \n		
        $fp = fopen($FileName, "r");
        fseek($fp, -1, SEEK_END);
        $pos = ftell($fp);
        $LastLine = "";
        // Loop backword util "\n" is found.
        while ((($C = fgetc($fp)) != "\n") && ($pos > 0)) {
            $LastLine = $C.$LastLine;
            fseek($fp, $pos--);
        }
        $LastLine = substr($LastLine, 0, -1);
        array_push($bank, $LastLine);

        fclose($myfile);

        return $bank;
    }

    // $record=array("unemployed","married","primary","no","no","cellular");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $bank = ReadFile1(
     'Bank Dataset.txt'
    );

    $TrainingSet = array();
    $ValidationSet = array();
    $TestingSet = array();

    $size50 = (50 / 100) * sizeof($bank);
    $size35 = (35 / 100) * sizeof($bank);
    $size15 = (15 / 100) * sizeof($bank);

  

    $pos = 1;
    for (; $pos < $size50; $pos++) {
        array_push($TrainingSet, $bank[$pos]);
    }

    for (; $pos < $size50 + $size35; $pos++) {
        array_push($ValidationSet, $bank[$pos]);
    }

    for (; $pos < sizeof($bank); $pos++) {
        array_push($TestingSet, $bank[$pos]);
    }


      ///////////////////////////////////////////////////////////find disenced

  function array_push_assoc($array,$index, $key, $value){
$array[$index][$key] = $value;
return $array;
}



$disencedYes=array(array(),array(),array(),array(),array(),array());
$disencedNo=array(array(),array(),array(),array(),array(),array());


 for ($j=0; $j < sizeof($TrainingSet); $j++) { 

 	  $line = explode(",", $TrainingSet[$j]);
            for ($i = 0; $i < 6; $i++) {
                

                    if ($line[6] == "yes" and array_key_exists($line[$i], $disencedYes[$i])) {
                        $disencedYes[$i][$line[$i]] += 1;
                    } 

                    elseif ($line[6] == "no" and array_key_exists($line[$i], $disencedNo[$i])) {
                        $disencedNo[$i][$line[$i]] += 1;
                    }


                    

                        else
                        {

                        

                        if ($line[6] == "yes") {
                        	$disencedYes = array_push_assoc($disencedYes,$i, $line[$i], 1);
                       
                    } 

                    if($line[6] == "no") {
                        $disencedNo = array_push_assoc($disencedYes,$i, $line[$i], 1);
                    }


                        }
              

            }
 	
 }

    echo "<pre>";
 //print_r($disencedNo);
    echo "</pre>";         




    ///////////////////////////////////////////////////

    //////
    $NumofYes = 0;
    $NumofNo = 0;
    for ($i = 0; $i < sizeof($TrainingSet); $i++) {
        $bufer1 = explode(",", $TrainingSet[$i]);
        if ($bufer1[6] == "yes") {
            $NumofYes++;
        } else {
            $NumofNo++;
        }
    }

    $PofYes = ($NumofYes / sizeof($TrainingSet));
    $PofNo = ($NumofNo / sizeof($TrainingSet));

    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////
    $correct = 0;
    for ($i = 0; $i < sizeof($ValidationSet); $i++) {
        $record1 = explode(",", $ValidationSet[$i]);

        if (findLabel12($record1) == $record1[6]) {
            $correct += 1;
        }
    }

    $accuracy = ($correct / sizeof($ValidationSet)) * 100;
    echo("<div class='outlier'>accuracy with Validation Set Bayesian :  ".$accuracy." % </div><br><br>");  
    echo "<pre>";
   //print_r($PnoArr);
    echo "</pre>";

    /////////////////////////////////////////k-nearest
   


   
  $correct1 = 0;
    for ($i = 0; $i < sizeof($TestingSet); $i++) {
        $record1 = explode(",", $TestingSet[$i]);

        if (k_nearest($record1) == $record1[6]) {
            $correct1 += 1;
        }
    }

    $accuracy1 = $correct1 / sizeof($TestingSet) * 100;
    echo("<div class='outlier'>accuracy with TestingSet k-nearest  :  ".$accuracy1." % </div>");

    ////////////////////////////////////////////
     $correct2 = 0;
    for ($i = 0; $i < sizeof($TestingSet); $i++) {
        $record1 = explode(",", $TestingSet[$i]);

        if (findLabel12($record1) == $record1[6]) {
            $correct2 += 1;
        }
    }

    $accuracy2 = ($correct2 / sizeof($TestingSet)) * 100;
    echo("<div class='outlier'> accuracy with TestingSet Bayesian  :  ".$accuracy2." %</div>");  
   
   ?>

</div>