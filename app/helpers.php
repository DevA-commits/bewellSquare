<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * dataTableRequests
 * @return result
 */
if (!function_exists('dataTableRequests')) {
    function dataTableRequests($request)
    {
        ## Read value
        $draw = $request['draw'];
        $start = $request['start'];
        $rowperpage = $request['length']; // Rows display per page

        $columnName_arr = $request['columns'];
        $search_arr = $request['search'];
        $searchValue = $search_arr['value']; // Search value


        $result = array(
            'draw' => $draw,
            'start' => $start,
            'rowperpage' => $rowperpage,
            'searchValue' => $searchValue,
            'rowperpage' => $rowperpage
        );

        return $result;
    }
}



/**
 * convert to title case
 */
if (!function_exists('convertToTitleCase')) {
    function convertToTitleCase($string)
    {
        // Replace underscores with spaces
        $string = Str::title(str_replace('_', ' ', $string));

        return $string;
    }
}

/**
 * status
 */
if (!function_exists('purchasePlanStatus')) {
    function purchasePlanStatus($status)
    {
        if ($status == 1) {
            $res = 'completed';
        } else {
            $res = 'in-progress';
        }
        return $res;
    }
}



/**
 * 12h time format
 */
if (!function_exists('normalTimeFormat')) {
    function normalTimeFormat($time)
    {

        $convertedTime = Carbon::createFromFormat('H:i:s', $time)->format('h:i A');

        return $convertedTime;
    }
}


/**
 * subtract hour
 */
if (!function_exists('subtractHourFormat')) {
    function subtractHourFormat($dateTime, $noOfHour)
    {

        $convertedTime = Carbon::parse($dateTime)->subHours($noOfHour);

        return $convertedTime;
    }
}


/**
 * custom date format
 */
if (!function_exists('customDateFormat')) {
    function customDateFormat($date, $format)
    {

        $convertedTime = Carbon::parse($date)->format($format);

        return $convertedTime;
    }
}

/**
 * Date format
 */
if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {

        $convertedDate = Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
        return $convertedDate;
    }
}

/**
 * module permission check
 */
if (!function_exists('module_permission_check')) {
    function module_permission_check($mod_name)
    {

        // if (auth()->user()->user_type == 'super_admin') return true;

        // $permission = auth()->user()?->permission?->modules;
        // if (isset($permission) && in_array($mod_name, (array)json_decode($permission)) == true) {
        //     return true;
        // }
        // return false;
        return true;
    }



    /**
     * successJson
     * @param message
     * @param data[]
     * @return Json
     */
    if (!function_exists('successJson')) {
        function successJson($message, $data)
        {
            return [
                'status' => true,
                'message' => $message,
                'data' => $data
            ];
        }
    }

    /**
     * errorJson
     * @param message
     * @param error
     * @return Json
     */
    if (!function_exists('errorJson')) {
        function errorJson($error, $data)
        {
            return [
                'status' => false,
                'message' => $error,
                'data' => $data
            ];
        }
    }

    function validateAndConvertYouTubeLink($youtubeLink)
    {
        // Regular expression to match the video ID from the YouTube link
        $pattern = '/(?:youtube.com\/(?:embed\/|v\/|watch\?v=|watch\?feature=player_embedded&v=|embed\/videoseries\?list=|user\/\S+\/\S+\/)|youtu.be\/|y2u.be\/|youtube.com\/\S*?[&?\#]v=|youtube.com\/embed\/|youtube.com\/user\/\S+?\/\S+?)([a-zA-Z0-9_-]{11})/';

        preg_match($pattern, $youtubeLink, $matches);

        if (count($matches) == 2) {
            $videoID = $matches[1];
            // Construct the embed link
            $embedLink = "https://www.youtube.com/embed/$videoID";
            return $embedLink;
        } else {
            // Invalid YouTube link
            return false;
        }
    }


}
