<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; //database
use App\Models\User; //user model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MailController;
use App\Mail\MailtrapExample;

class UserController extends Controller{
    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */


    /*-- Create --*/
    public function Register(Request $request)
    {
        $user = new User();
        if($request->profile_pic_url == "" || $request->profile_pic_url == NULL) //if user doesn't provide with profile picture, don't add anything to let default value set its profile picture
        {
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->age = $request->age;
            $user->save();
            Mail::to($request->email)->send(new MailtrapExample($user->id));
        }
        else
        {
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->profile_pic_url = $request->profile_pic_url;
            $user->age = $request->age;
            $user->save();
            Mail::to($request->email)->send(new MailtrapExample($user->id));
        }
    }

    public function TestCreate()
    {
        DB::table('users')->insert([
            'username' => 'adrien',
            'email' => 'adrien@mail.com',
            'password' => '123',
            'age' => '18'
        ]);
    }

    /* Email */

    public function validateAccount($id)
    {
        $user = User::find($id);
        $user->email_verified_at = "1";
        $user->save();
    }

    public function EmailIsVerified($id)
    {
        $user = User::find($id);
        if($user->email_verified_at != "0")
        {
            return;
        }
        else
        {
            $this->verifyEmail($user->id);
            return "Error, the email was not verified, another email was sent to the email adress you entered, please make sure the adress is valid";
        }
    }

    

    /* --- Read --- */
    public function GetUsers()
    {
        $users = User::all();
        return json_encode($users);
    }

    public function getUser($id)
    {
        $user = User::find($id);
        return json_encode($user);
    }

    public function GetAdminStatus($id)
    {
        $user = User::find($id);
        $admin_status = $user->admin_status;
        return json_encode($admin_status);
    }

    public function getUserAge($id)
    {
        $user = User::find($id);
        return json_encode($user->age);
    }

    public function getUserWithUsername($username)
    {
        $user = User::where("username", "=", $username)->first();
        return json_encode($user);
    }

    public function Login(Request $request)
    {
        $user = User::where('username', '=', $request->username)->firstOrNew(); //contains all user credentials at precise username
        // return json_encode($user);
        $user_username = $user->username;
        $user_password = $user->password;
        $user_verified_status = $user->email_verified_at;
        if($user_verified_status === NULL || $user_verified_status == "0")
        {
            $user->delete();
            return "Email was not verified, user delete from database";
        }
        else
        {
            if($user_username === NULL || $user_password === NULL)
            {
                return "Incorrect credentials"; 
            }
    
            if($user_username === $request->username && $user_password === $request->password) //if form data matches database data
            {
                return json_encode($user);
            } 
            else
            {
                return "credentials don't match";
            }
        }

        
    }

    /*-- Update --*/
    public function updateUserByUser($id, Request $request)
    {
        $user = User::find($id);

        /* Old credentials */
        $old_username = $user->username;
        $old_email = $user->email;
        $old_password = $user->password;
        $old_profile_pic_url= $user->profile_pic_url;
        $old_age = $user->age;

        /* Enabling optional fields filling */
        if($request->username == NULL || $request->username == "")
        {
            $request->username = $old_username;
        }
        if($request->email == NULL || $request->email == "")
        {
            $request->email = $old_email;
        }
        if($request->password == NULL || $request->password == "")
        {
            $request->password = $old_password;
        }
        if($request->profile_pic_url == NULL || $request->profile_pic_url == "")
        {
            $request->profile_pic_url = $old_profile_pic_url;
        }
        if($request->age == NULL || $request->age == "")
        {
            $request->age = $old_age;
        }

        /* Updating user */
        DB::table("users")->where("id", "=", $user->id)->update([
            'username' => $request->username, 
            'email' => $request->email, 
            'password' => $request->password, 
            'profile_pic_url' => $request->profile_pic_url, 
            'age' => $request->age
        ]);

    }


    public function UpdateUser($id, Request $request)
    {
        $user = User::find($id);

        /* Old credentials */
        $old_username = $user->username;
        $old_email = $user->email;
        $old_password = $user->password;
        $old_profile_pic_url= $user->profile_pic_url;
        $old_admin_status = $user->admin_status;
        $old_age = $user->age;

        /* Enabling optional fields filling */
        if($request->username == NULL || $request->username == "")
        {
            $request->username = $old_username;
        }
        if($request->email == NULL || $request->email == "")
        {
            $request->email = $old_email;
        }
        if($request->password == NULL || $request->password == "")
        {
            $request->password = $old_password;
        }
        if($request->profile_pic_url == NULL || $request->profile_pic_url == "")
        {
            $request->profile_pic_url = $old_profile_pic_url;
        }
        if($request->admin_status == NULL || $request->admin_status)
        {
            $request->admin_status = $old_admin_status;
        }
        if($request->age == NULL || $request->age == "")
        {
            $request->age = $old_age;
        }

        DB::table("users")->where("id", "=", $user->id)->update([
            'username' => $request->username, 
            'email' => $request->email, 
            'password' => $request->password, 
            'profile_pic_url' => $request->profile_pic_url, 
            'age' => $request->age, 
            'admin_status' => $request->admin_status
        ]);
    }

    /*-- Delete --*/
    public function TestDelete($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    
}

?>