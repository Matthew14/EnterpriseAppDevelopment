<?php

/**
 * Keeping it DRY (Y)
 * @author Matthew O'Neill / C11354316
 */


/**
 * Calculates the average (mean) of the numbers located in subarrays of the given array
 * at the specified index
 *
 * @example input: array(0 => array("number" => 4), 1 => array("number" => 6))
 *      with $field = "numbers"
 *      will return 5
 *
 * @param array $data
 * @return the average of all numbers in the sub arrays at given index
 * @throws UnexpectedValueException if any element at given index is not number
 * @throws OutOfBoundsException if any array in the outer array does not contain $field as index
 * @throws InvalidArgumentException if the array is null or empty
 */
function average($data, $field){
    $total = 0;

    if ($data == null || ! is_array($data) || count($data) < 1)
        throw new InvalidArgumentException("Need an array with stuff in it, friendo");

    $numTasks = count($data);

    for ($i = 0; $i < $numTasks; ++$i){
        if(array_key_exists($field, $data[$i]))
            $num = $data[$i][$field];
        else
            throw new OutOfBoundsException("Key not here, friendo");

        if (!is_numeric($num))
            throw new UnexpectedValueException("this function only likes numbers");

        $total+= $num;
    }
    return $total / $numTasks;
}

/**
 * Returns the population standard deviation of the numbers located on subarrays of the
 * given array at the specified index
 *
 * @param array $data
 * @return the standard deviation of all numbers in the sub arrays at given index
 * @throws UnexpectedValueException if any element at given index is not number
 * @throws OutOfBoundsException if any array in the outer array does not contain $field as index
 * @throws InvalidArgumentException if the array is null or empty
 */
function stdDev($data, $field){

    //no need to check inputs as average() will do this:
    $average = average($data, $field);

    $numTasks = count($data);

    $total = 0;

    for ($i = 0; $i < $numTasks; ++$i)
        $total += pow($data[$i][$field] - $average, 2);

    return sqrt($total/$numTasks);
}
?>
