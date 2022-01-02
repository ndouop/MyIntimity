<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect("/profile");
    }

    public function welcome(){
        $compacted = [];

        $users = \App\Models\User::where('actif','=',true)->count();
        $subjects = \App\Models\Sujet::where('actif','=',true)->count();
        $categories = \App\Models\Categorie::where('actif','=',true)->count();
        $sujets_like = \App\Models\Sujet::whereActif(true)
                                ->orderBy('nblike','DESC')
                                    ->limit(10)
                                    ->get();

        $compacted = array(
            'users_c' =>$users ,
            'subjects_c' => $subjects,
            'categories_c' => $categories,
            'sujets_like' => $sujets_like
            );

        return view('front.acceuil',$compacted);
    }

    public function contactMyIntimity(Request $request)
    {
        $rules = ["message"=>"required","email"=>"required|email"];
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return back()->withError("error");
        }
        $response = $this->sendEmail($request->email,$request->nom,"contacts us",$request->content);

        dd($response);

        return back()->withSuccess("success");

    }

    public function sendEmail($user_email,$user_name,$title,$content)
    {
        /*
        $title = "test Intimity email";
        $content = "je suis le contenu du mail";
        $user_email = "nivekalara237@gmail.com";
        $user_name = "kemta";
        */
        try
        {
            $data = ['email'=> $user_email,'name'=> $user_name,'subject' => $title, 'content' => $content];
            \Mail::send('emails/test', $data, function($message) use($data)
            {
                $subject=$data['subject'];
                $message->from('services@vision-numerique.com');
                $message->to($data['email'], $data['name'])->subject($subject);
            });

            return true;
        }
        catch (\Exception $e){
        
            return $e->getMessage();
        }

    }

    public function souscribeToNewsletter(Request $request)
    {
        $email = $request->email;
        $check_if_exist = \DB::table('newsletterContacts')->select("*")->where(["email"=>$email])->get();
        if (count($check_if_exist)>0) {
            return response()->json(["status"=>false,"motif"=>trans("back/home.error_s_newsletter")]);
        }
        \DB::table("newsletterContacts")
                ->insert(["email"=>$email]);
        return response()->json(["status"=>true,"message"=>trans("back/home.success_s_newsletter")]);
    }

}
