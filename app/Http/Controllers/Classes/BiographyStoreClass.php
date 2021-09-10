<?php

namespace App\Http\Controllers\Classes;

class BiographyStoreClass {
    public static function update($bio, $biography) {
        $updatedBio = $bio->update([
            'biography' => $biography
        ]);

        return $updatedBio;
    }

    public static function create($bio, $biography)
    {
        $createdBio = $bio->create([
            'biography' => $biography,
        ]); 

        return $createdBio;
    }
}