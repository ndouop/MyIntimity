<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Pay;
use App\Models\Region;
use App\Models\Ville;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    protected function messages(){
        return array(
            "login.required"=>"Le champs :attribute est requis",
            "email"=>array(
                "required"=>"le champs login est requis",
                "email"=>"Le champs :attribute doit etre un email valide. x.y.z@abc.cmn",
                "max"=>"le champs :attribute doit avoir au maximuù 255 caractère",
                "unique"=>"Cetta adresse email est déjà utilisé par un autre utilisateur.",
            ),
            "password.required"=>"le champs :attribute doit",
            "password.min"=>"le champs :attribute doit avoir au moins 6 caractère",
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'passfire'=>$data["password"],
            'password' => bcrypt($data['password']),
        ]);



        /*if ($user) {
            return response()->json(["statut"=>true,"message"=>"Compte créé avec succes. Nous vous remercions infiniment."]);
        }
        return response()->json(["statut"=>false,"message"=>"Compte créé avec succes. Nous vous remercions infiniment."]);*/
    }

    public function registerWithFb(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:4',
        ]);

        if ($validator->fails()) {
             return response()->json(["status"=>false,"validator"=>true,"errors"=>$validator->errors()]);
        }

        $user = User::create([
                    'login' => $request['login'],
                    'email' => $request['email'],
                    'passfire'=>$request["password"],
                    'password' => bcrypt($request['password']),
                ]);

        $data = $request->all();
        $ville_id = null;
        $region_id = null;
        $pays_id = null;

        if(!is_null($user)){ // on crée le profil
            $pays = Pay::where('code', strtoupper($data['code']))->get();
            if(count($pays) > 0){
                $pays_id = $pays[0]->id;

                $region = Region::where('nom', 'like', '%'.$data['region'].'%')->where('pay_id',$pays_id)->get();
                if(count($region) > 0){
                    $region_id = $region[0]->id;

                    $ville = Ville::where('nom', 'like', '%'.$data['ville'].'%')->where('region_id',$region_id)->get();
                    if(count($ville) > 0){
                        $ville_id = $ville[0]->id;

                    }else{
                        $ville = new Ville();
                        $ville->nom = $data['ville'];
                        $ville->region_id = $region->id;
                        $ville->save();

                        $ville_id = $ville->id;
                    }

                }else{
                    $region = new Region();
                    $region->nom = $data['region'];
                    $region->pay_id = $pays_id;
                    $region->save();
                    $region_id = $region->id;
                    $ville = new Ville();
                    $ville->nom = $data['ville'];
                    $ville->region_id = $region->id;
                    $ville->save();

                    $ville_id = $ville->id;
                }
            }else{ // on enregistre son pays, sa region  et sa ville
                $pays = new Pay();
                $pays->code = $data['code'];
                $pays->nom = $data['pays_nom'];
                $pays->save();
                $pays_id = $pays->id;

                $region = new Region();
                $region->nom = $data['region'];
                $region->pay_id = $pays->id;
                $region->save();
                $region_id = $region->id;

                $ville = new Ville();
                $ville->nom = $data['ville'];
                $ville->region_id = $region->id;
                $ville->save();

                $ville_id = $ville->id;


            }
            $ip = \App\Models\Ville_ip::where('ville_id', $ville_id)->where('ip', $data['ip'])->get();
            if(count($ip) <= 0){
                $ip = new \App\Models\Ville_ip();
                $ip->ville_id = $ville_id;
                $ip->ip = $data['ip'];
                $ip->save();
            }
            $user->pay_id = $pays_id;
            $user->region_id = $region_id;
            $user->ville_id = $ville_id;
            $user->save();
        }

        \Auth::login($user);

        return response()->json(["status"=>true,"validator"=>false,"message"=>trans("back/user.success_store")]);
    }
}
