<?php

namespace App;

class Helper
{
    /**
     * Returns datediff from now to more readable format
     * @param $creationDate
     * @param bool $now|timestamp
     * @return string
     */
    public static function dateToDiff($creationDate, $now = false)
    {
        $timestamp = strtotime($creationDate);
        $now = $now ?: time();

        $diff = $now - $timestamp;

        if ($diff < 10) {
            return "Few seconds ago";
        } else if ($diff < 200){
            return "Few minutes ago";
        } else if ($diff < 3600) {
            return intval($diff / 60) . " minutes ago";
        } else if ($diff < 3600*24) {
            return intval($diff / 3600) .  " hours ago";
        } else {
            return intval($diff / (3600*24)) . " days ago";
        }
    }

    public static function getSeverityClass($severity) {
        if ($severity < 2) {
            return "";
        } else if ($severity < 3) {
            return "bg-info";
        } else if ($severity < 5) {
            return "bg-warning";
        } else {
            return "bg-danger";
        }
    }
}