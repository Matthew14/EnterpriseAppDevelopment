<?php
    function average($data, $field){
        $total = 0;
        $numTasks = count($data);
        for ($i = 0; $i < $numTasks; ++$i)
            $total+= $data[$i][$field];
        return $total / $numTasks;
    }

    function stdDev($data, $field){
        $average = average($data, $field);
        $numTasks = count($data);

        $total = 0;

        for ($i = 0; $i < $numTasks; ++$i)
            $total += pow($data[$i][$field] - $average, 2);

        return sqrt($total/$numTasks);
    }
 ?>
