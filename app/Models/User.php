<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public function updateProfile($data,$id){
        $updateData=[
            'name' => $data->name,
            'name_kana' => $data->kana,
            'email' => $data->email,
        ];

        if ($data->hasFile('image')) {
            $image = $data->file('image');
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/images/profile', $file_name);

            $image_path = 'storage/images/profile/' . $file_name;
            $updateData['profile_image'] = $image_path;
        }
        DB::table('users')->where('id', $id)->update($updateData);
    }

    public function updatePassword($newPassword)
    {
        $this->password = $newPassword;
        $this->save();
    }
}
