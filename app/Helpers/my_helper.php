<?php
// use CodeIgniter\CodeIgniter;


function generateCustomCode($userId)
{
    // Get current date and time
    $now = new \DateTime();

    // Extract individual date and time components
    $month = $now->format('m');
    $day = $now->format('d');
    $year = substr($now->format('Y'), -2); // Last two digits of the year
    $hour = $now->format('H');
    $minute = $now->format('i');
    $second = $now->format('s');

    // Format the user ID to 4 digits
    $userId = str_pad($userId, 4, '0', STR_PAD_LEFT);

    // Format the components into the desired code format
    $code = sprintf('%04d-%02d%02d%02d-%02d%02d%02d', $userId, $month, $day, $year, $hour, $minute, $second);

    return $code;
}

// // Example usage:
// $userId = 123; // Example user ID
// $code = generateCustomCode($userId);
// echo "Generated Code: $code";



function convertPhpElapsedTime($timeString) {
    // Sample input: '0y, 6d, 4hr, 1min, 9sec'
    // PHP elapsed time output
    
    // Extracting numerical values and units from the time string
    $regex = '/(\d+)([a-zA-Z]+)/';
    $totalSeconds = 0;

    preg_match_all($regex, $timeString, $matches);

    foreach ($matches[1] as $key => $value) {
        $unit = strtolower($matches[2][$key]);
        
        switch ($unit) {
            case 'y':
                $totalSeconds += $value * 365 * 24 * 60 * 60;
                break;
            case 'd':
                $totalSeconds += $value * 24 * 60 * 60;
                break;
            case 'hr':
                $totalSeconds += $value * 60 * 60;
                break;
            case 'min':
                $totalSeconds += $value * 60;
                break;
            case 'sec':
                $totalSeconds += $value;
                break;
        }
    }

    // Convert total seconds to a human-readable format
    $intervals = [
        ['label' => 'year', 'seconds' => 365 * 24 * 60 * 60],
        ['label' => 'day', 'seconds' => 24 * 60 * 60],
        ['label' => 'hour', 'seconds' => 60 * 60],
        ['label' => 'minute', 'seconds' => 60],
        ['label' => 'second', 'seconds' => 1]
    ];

    $result = '';
    $remainingSeconds = $totalSeconds;
    foreach ($intervals as $interval) {
        $count = floor($remainingSeconds / $interval['seconds']);
        if ($count > 0) {
            $result .= $count . ' ' . $interval['label'] . ($count !== 1 ? 's' : '') . ' ';
            break; // Stop once the highest unit is found
        }
    }

    return $result . 'ago';
}

function timeStampElapsedTime($time_stamp){
    $timezone = new DateTimeZone('Asia/Manila');
    $dateNow = new DateTime();
    $date = new DateTime($time_stamp, $timezone);
    $elapsed_time = convertPhpElapsedTime($date->diff($dateNow)->format('%yy, %dd, %hhr, %imin, %ssec'));
    // return value sample like 10 days ago or 3hrs ago, etc
    return  $elapsed_time;
}

function timeStampDateFormat($time_stamp,$php_date_string_format = 'M d, Y D h:i A'){
    $timezone = new DateTimeZone('Asia/Manila');
    $date = new DateTime($time_stamp, $timezone);
    $formatted_date = date_format($date, $php_date_string_format);
    return  $formatted_date;
}

