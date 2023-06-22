<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary calculator</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    /*
    * 582-11B-MA Exercice 3
    * Etudiant : Rostyslav Luchyshyn - 2395286
    */
    /*Entrées:
    *- tableau des heures rémunérés par chaque jour de la semaine
    *- rémunération à l'heure
    *Sorties
    *- tableau des payements de la semaine en HTML
    *- calcul de taux d'imposition
    *- salaire brut (annuelle et hebdomadaire) 
    *- salaire net (annuelle et hebdomadaire)
    */
    
    /*la fonction de calcul du paiement pour chaque jour de travail et de vérification du nombre d'heures travaillées par rapport aux normes */

    function calculateDailySalary($hourlyRate, $hoursWorked) {
        $dailyPay=0;

        if ($hoursWorked<=8) {
          $dailyPay=$hoursWorked*$hourlyRate;
        } else {
          $dailyPay=(8*$hourlyRate)+((($hoursWorked-8)*$hourlyRate)*1.5);
        }
        return $dailyPay;
      }

    /*la fonction de remplir le tableau des salaires pour chaque jour */
      function calculateWeeklySalaryArray($hourlyRate, $hoursWorkedPerDay) {
        $weeklyPayArray=array();
        foreach($hoursWorkedPerDay as $hoursWorked) {
            $dailyPay = calculateDailySalary($hourlyRate, $hoursWorked);
            array_push($weeklyPayArray, $dailyPay);
        }
        return $weeklyPayArray;
      }
      
      /*la fonction d'affichage des calculs sous forme de tableau HTML*/
      function showTable($hourlyRate, $hoursWorkedPerDay){
        $countArray=count($hoursWorkedPerDay);
        for ($i=0; $i < count($hoursWorkedPerDay); $i++) { 
            if (is_float($hoursWorkedPerDay[$i])!=1 && is_numeric($hourlyRate)!=1) {
                echo '<strong>', 'Error: ', '</strong>', 'Ce n\'est pas une chiffre ', '<br>';
                echo '<a href="index.html">Back to main page</a>';
                return;
            }
            if ($hoursWorkedPerDay[$i]>16) {
                echo '<strong>', 'Error: ', '</strong>', 'C\'est ne pas posible de travaille plus que 14 heueres par jour ', '<br>';
                echo '<a href="index.html">Back to main page</a>';
                return;
            }
            if ($hoursWorkedPerDay[$i]<0) {
                echo '<strong>', 'Error: ', '</strong>', 'Heures ne peut etre moin 0', '<br>';
                echo '<a href="index.html">Back to main page</a>';
                return;
            }

            //echo $hoursWorkedPerDay[$i];
          }
        if ($countArray!=7) {
            echo '<strong>', 'Error: ', '</strong>', 'Il y a 7 jours dans une semaine !', '<br>';
            echo '<a href="index.html">Back to main page</a>';
            return;
        }
        if ($hourlyRate<14.5) {
            echo '<strong>', 'Error: ', '</strong>', 'Rémunération à l\'heure n\'est peut pas être moins que 14.5 !', '<br>';
            echo '<a href="index.html">Back to main page</a>';
            return;
        }

        $daysOfWeek=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $weekPay=0;
        $a=0;
        $b=0;
        $lenghtDaysOfWeek=count($daysOfWeek);
        $resault=calculateWeeklySalaryArray($hourlyRate, $hoursWorkedPerDay);
        echo '<table>';
        echo '<tbody>', '<thead>', '<tr>', '<th>', 'Day', '</th>', '<th>', 'Pay', '</th>', '</tr>', '</thead>';
        while ($a < $lenghtDaysOfWeek && $b < $lenghtDaysOfWeek) {
            echo  '<tr>', '<td>', $daysOfWeek[$a], '</td>', '<td  class="hours">', $resault[$b], '</td>','</tr>';
            $a++;
            $b++; 
        }
        for ($i=0; $i < count($resault); $i++) { 
            $weekPay+=$resault[$i];
        }
        echo '</tbody>';
        echo '<tfoot>', '<tr>', '<td>', 'Total week befor tax:', '</td>', '<td class="hours">', $weekPay, '</td>', '<tr>', '</tfoot>';
        echo '</table>';
        $salaryYear=52*$weekPay;
        echo 'Predicted salary per year: ' , $salaryYear, '$', '<br>';
        /* calcul de taux d'imposition */ 
        if ($salaryYear<=50197) {
            $impot='15';
        }
        elseif ($salaryYear>50197 && $salaryYear<55233) {
            $impot='20,5';
        }
        elseif ($salaryYear>55233 && $salaryYear<66083) {
            $impot='26';
        }
        elseif ($salaryYear>66083 && $salaryYear<221708) {
            $impot='29';
        }
        elseif ($salaryYear>221708) {
            $impot='33';
        }
        /*calculation de salaire apres d'imposition*/
        switch ($impot) {
            case '15':
                $salaryNet=$weekPay*0.85;
                break;
            case '20,5':
                $salaryNet=$weekPay*0.795;
                break;
            case '26':
                $salaryNet=$weekPay*0.75;
                break;
            case '29':
                $salaryNet=$weekPay*0.71;
                break;
            case '33':
                $salaryNet=$weekPay*0.67;
                break;
        }
        echo 'Hourly pay: ', $hourlyRate, '$', '<br>';
        echo 'Tax rate: ', $impot, '%', '<br>';
        echo 'Salary per week after tax: ', $salaryNet, '$', '<br>';
        $salaryYearNet=52*$salaryNet;
        echo 'Predicted salary per year: ' , $salaryYearNet, '$', '<br>';
        echo '<a href="index.html">Back to main page</a>';
      }


?>
</body>
</html>