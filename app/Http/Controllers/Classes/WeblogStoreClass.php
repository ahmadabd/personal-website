<?php

namespace App\Http\Controllers\Classes;

class WeblogStoreClass {
    public static function update($weblog, $weblogUrl)
    {
        $updatedWeblog = $weblog->update([
            'weblog_address' => $weblogUrl
        ]);

        return $updatedWeblog;
    }

    public static function create($weblog, $weblogUrl)
    {
        $createdWeblog =  $weblog->create([
            'weblog_address' => $weblogUrl
        ]);

        return $createdWeblog;
    }
}