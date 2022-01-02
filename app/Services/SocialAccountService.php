<?php

namespace App\Services;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Carbon\Carbon;
//use Intervention\Image;

class SocialAccountService
{

    public function createOrGetUser(ProviderUser $providerUser, $provider)
    {
        //width of the resized image
        $avatar_target_size = [500, 100];

        $account = SocialAccount::whereProvider($provider)
                                        ->whereProviderUserId($providerUser->getId())
                                        ->first();
        if ($account) {
            return $account->user;
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider
            ]);
            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                $email = $providerUser->getEmail();
                if(is_null($email) || $email == ""){
                    return null;
                }
                $pwd = substr(uniqid(), 0, 8);
                $filename = "";

                /*var_dump($providerUser->avatar_original);
                var_dump($providerUser->getEmail());
                var_dump($providerUser->getName());
                var_dump($providerUser->getName());
                var_dump($providerUser->user);
                var_dump($providerUser->user['gender']);

                die();*/


                if(!is_null($providerUser->avatar_original) && $providerUser->avatar_original != "") {
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


                }
                $login = explode('@', $providerUser->getEmail())[0];
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'nom' => $providerUser->getName(),
                    'avatar' => $filename,
                    'sexe' => $providerUser->user['gender'],
                    'login' => $login,
                    'password' => bcrypt($pwd),
                ]);
                Mail::to($email)
                    ->send(new Contact($email, $pwd, 'register', null));

            }
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
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