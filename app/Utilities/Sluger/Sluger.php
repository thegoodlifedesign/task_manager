<?php namespace TGLD\Utilities\Sluger;


class Sluger
{
    /**
     * Slug any string
     *
     * @param $str
     * @return mixed|string
     */
    public function sluggify($str)
   {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

        return $clean;
    }
}