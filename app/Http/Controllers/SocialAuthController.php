<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Auth;
use Flash;

class SocialAuthController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return \Socialite::driver('facebook')->redirect();
    }
    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function handleFacebookCallback(SocialAccountService $service, Request $request)
    {
        // Added it here

        if (!$request->has('code') || $request->has('denied')) {
            return redirect('/');
        }
        
        
        try {

            $leuser = \Socialite::driver('facebook')->user();
            $user = $service->createOrGetUser($leuser, 'facebook');
            if(is_null($user)){
                Flash::success(trans("back/socialAuth.not_fck_email"));
                return redirect('/');
            }
            Auth::loginUsingId($user->id);
            return redirect()->to('/profile');

        }catch (Exception $e) {

            Flash::success(trans("back/socialAuth.save_cancel"));
            return redirect('/');
        }

    }

    public function redirectToGoogle()
    {
        return \Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(SocialAccountService $service)
    {
        try {
            $user = \Socialite::driver('google')->user();
            //$leuser = \Socialite::driver('facebook')->user();
            //var_dump($service);
            //echo '======================================================================================== <br>';
            //var_dump($leuser);
            //die();
            $user = $service->createOrGetUser($user, 'google');
            if(is_null($user)){
                Flash::success(trans("back/socialAuth.not_gmail_email"));
                return redirect('/');
            }
            //Auth::login($user, true);
            Auth::loginUsingId($user->id);
            //auth()->login($user);
            return redirect()->to('/profile');

        } catch (Exception $e) {
            return redirect('/redirect/facebook');
        }
    }



    public function testImage()
    {
        echo __FILE__;
        $filename = uniqid() . '.png';
        $ch = "https://graph.facebook.com/v2.10/1462128207188825/picture?width=1920";

        $source_properties = getimagesize($ch);
        $image = file_get_contents($ch);
        $image = imagecreatefromstring ($image);
        imagejpeg ($image, 'images/avatars/' . $filename);

        //image de profile
        $target_layer = $this->resizeImage($image,500, $source_properties);
        imagejpeg ($target_layer, 'images/avatars/profile/profile_' . $filename);
        //image des commentaire
        $target_layer = $this->resizeImage($image,100, $source_properties);
        imagejpeg ($target_layer, 'images/avatars/thumbnails/thumb_' . $filename);


        echo getcwd();


    }



    function resizeImage($image,$target_width, $source_properties) {
        //$source_properties = getimagesize($image);
        $proportion = ($target_width / $source_properties[0]);
        $target_height = intval($source_properties[1] * $proportion);
        $target_layer = imagecreatetruecolor($target_width,$target_height);
        imagecopyresampled($target_layer, $image, 0, 0, 0, 0, $target_width, $target_height, $source_properties[0], $source_properties[1]);
        return $target_layer;
    }

}
