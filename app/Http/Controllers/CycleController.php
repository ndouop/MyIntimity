<?php
/**
 * Created by PhpStorm.
 * User: wv
 * Date: 11/23/2016
 * Time: 2:59 PM
 */

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Sujets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Repositories\UserRepository;

class CycleController extends Controller
{
	private $userRepository;

  function __construct(UserRepository $userRepository)
  {

	$this->userRepository = $userRepository;
  }

  
  public function cycle(Request $request){

      if(auth()->check()) {
          $result = array();
          Session::forget('notes');
          // les sujets les plus aim�
          if($request->isMethod('post')){
              $this->maj_calander($request);
          }
          $invitation_sent_in_agreement = \App\Models\Friend::whereFriendAndEtat(auth()->user()->id, false)->get();
          $friends = auth()->user()->friends();
          $nbFriend = count($friends);

          return view('cycle1', compact('friends', 'nbFriend', 'invitation_sent_in_agreement'));
      }else{
          $result = array();
          Session::forget('notes');
          // les sujets les plus aim�
          if($request->isMethod('post')){
              $this->maj_calander($request);
          }
          return view('cycle1');
      }
      /*
      $result = array();
      Session::forget('notes');
      // les sujets les plus aim�
      if($request->isMethod('post')){
          $this->maj_calander($request);
      }
      return view('cycle1');
      */
  }

  public function maj_calander(Request $request){
      //if($request->ajax()){
          $ddr = new \Datetime($request->ddr);
          //$ddr = new \Datetime('25-11-2016');
          $dcycle = $request->dcycle;
          $dseign = $request->dseign;
		  $dmin = $request->dmin;
		  $dmax = $request->dmax;
		  $estRegulier= $request->estRegulier;
		  
		  if(\Auth::check()){
			  $user = $this->userRepository->findOrFail(\Auth::user()->id);
			  if(!empty($user)){
				 //$this->userRepository->updat
			  }
			  
		  }
		  
          $ddr_ok = Carbon::create(date_format($ddr, "Y"), date_format($ddr, "m"), date_format($ddr, "d"), 0);
          //$ddr_ok = Carbon::now();
          $drr_suiv = Carbon::create(date_format($ddr, "Y"), date_format($ddr, "m"), date_format($ddr, "d"), 0);
          $drr_pev = Carbon::create(date_format($ddr, "Y"), date_format($ddr, "m"), date_format($ddr, "d"), 0);
          $p_post_ovul = 14;
          $etats = array();
          /*var_dump(new \Datetime($request->ddr));
          echo '<br/>'. $drr_suiv.'<br/>'. $drr_pev.'<br/><br/>'; */
         // { "date": "2016-05-25", "note": ["Natal"] },
          // suiv
          for($i=1; $i<15; $i++){ // on calcule sur 15 cycle pour que les precisions soient sur plusieurs mois
              // suiv

             // echo $drr_suiv.'<br/>';
              $etats[]=array( // premier jour des regles
                  "date" =>$drr_suiv->format('Y-m-j'),
                  "note" =>Lang::get('cycle.debut_seign'),
                  "classe" =>"rouge",
              );

              for($j = 1; $j<$dseign; $j++){ // les autres jours des regles
                  $tmp = Carbon::create(date_format($drr_suiv, "Y"), date_format($drr_suiv, "m"), date_format($drr_suiv, "d"), 0);

                  $etats[]=array(
                      "date" =>$tmp->addDays($j)->format('Y-m-j'),
                      "note" =>Lang::get('cycle.seign'),
                      "classe" =>"rouge",
                  );
              }

              // periode feconde
              //$fin_cycle = $drr_suiv->addDays($dcycle - 1);
              $fin_cycle = Carbon::create(date_format($drr_suiv, "Y"), date_format($drr_suiv, "m"), date_format($drr_suiv, "d"), 0)->addDays($dcycle - 1);

              $ovulation = $fin_cycle->subDays($p_post_ovul -1);
              // ovulation et periode probable pou un gar�on
              $etats[]=array(
                  "date" => $ovulation->format('Y-m-j'),
                  "note" =>Lang::get('cycle.ovulation'),
                  "classe" =>"blue",
              );

              $etats[]=array(
                  "date" =>$ovulation->addDay()->format('Y-m-j'),
                  "note" =>Lang::get('cycle.propice_gar'),
                  "classe" =>"blue",
              );

              // periode probable pour une fille
              $etats[]= array(
                  "date" =>$ovulation->subDay(1+1)->format('Y-m-j'),
                  "note" =>Lang::get('cycle.propice_fille'),
                  "classe" =>"rose",
              );

              $etats[]= array(
                  "date" =>$ovulation->subDays(2 -1)->format('Y-m-j'),
                  "note" =>Lang::get('cycle.propice_fille'),
                  "classe" =>"rose",
              );
              //fin

              $drr_suiv->addDays($dcycle - 1);
          }

          // prev
      echo '<br/><br/><br/>';
          for($k=1; $k<10; $k++){ // on calcule sur 15 cycle pour que les precisions soient sur plusieurs mois
              // suiv

              $drr_pev->subDays($dcycle -1);
              //$drr_pev = $precedent;
             //echo $dcycle. '  '.$drr_pev.'<br/>';
              $etats[]=array( // premier jour des regles
                  "date" =>$drr_pev->format('Y-m-j'),
                  "note" =>Lang::get('cycle.debut_seign'),
                  "classe" =>"rouge",
              );

              for($k1 = 1; $k1<$dseign; $k1++){ // les autres jours des regles
                  $tmp = Carbon::create(date_format($drr_pev, "Y"), date_format($drr_pev, "m"), date_format($drr_pev, "d"), 0);

                  $etats[]=array(
                      "date" =>$tmp->addDays($k1)->format('Y-m-j'),
                      "note" =>Lang::get('cycle.seign'),
                      "classe" =>"rouge",
                  );
              }

              // periode feconde
              $fin_cycle = Carbon::create(date_format($drr_pev, "Y"), date_format($drr_pev, "m"), date_format($drr_pev, "d"), 0)->addDays($dcycle - 1);

              //$fin_cycle = $drr_pev->addDays($dcycle - 1);
              $ovulation = $fin_cycle->subDays($p_post_ovul -1);
              // ovulation et periode probable pou un gar�on
              $etats[]=array(
                  "date" => $ovulation->format('Y-m-j'),
                  "note" =>Lang::get('cycle.ovulation'),
                  "classe" =>"blue",
              );

              $etats[]=array(
                  "date" =>$ovulation->addDay()->format('Y-m-j'),
                  "note" =>Lang::get('cycle.propice_gar'),
                  "classe" =>"blue",
              );

              // periode probable pour une fille
              $etats[]= array(
                  "date" =>$ovulation->subDays(1+1)->format('Y-m-j'), // 2 car on a d'ab ajouter 1
                  "note" =>Lang::get('cycle.propice_fille'),
                  "classe" =>"rose",
              );

              $etats[]= array(
                  "date" =>$ovulation->subDays(2 -1)->format('Y-m-j'),
                  "note" =>Lang::get('cycle.propice_fille'),
                  "classe" =>"rose",
              );

              //$drr_pev = $drr_pev->subDays($dcycle - 1);
          }



          /*Session::put('notes', Response::json(array(
              'notes' => $etats,
              'status_code' => 200
          )));*/
          //return $etats;
          Session::put('notes',json_encode($etats));
          /*Session::put('notes',Response::json($etats
              ));*/
      //var_dump(Session::get('notes')); die();
      //die();
          return Session::get('notes');


     //}
  }

    public function notes(Request $request){
        if($request->ajax()){
            if(Session::has('notes'))
                return Session::get('notes');
            else
                return json_encode(array());
        }

    }
}