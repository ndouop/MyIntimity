<?php


if (!function_exists('getTimeHumansPoster')) {
	function getTimeHumansPoster($date){
		\Carbon\Carbon::setLocale(config('app.locale'));

		$ndate = str_replace('/', '-', $date);

		$local = \Carbon\Carbon::parse($ndate);
		$today = \Carbon\Carbon::now();
		$diff = $local->diffInSeconds($today);
		$response = \Carbon\Carbon::now()->subSeconds($diff)->diffForHumans();

		return $response;
	}
}

if (!function_exists('reduceText')) {
	function reduceText($text,$length,$redirect=false,$more=null){
		//$text_replace = substr($text,0,$length);
		$text_replace = mb_strimwidth($text, 0, $length, "...");

		if (!$redirect) 
			$display = $text_replace.'<a href="#" onclick="event.preventDefault();getMoreTextHasBeenReduce("'.substr($text,$length,strlen($text)).'")">more</a>';
		else{
        if (is_null($more))
          $display = $text_replace;
        else
          $display = $text_replace.'';
      }
		return $display;
	}
}

if (!function_exists("extract_img_to_string")) {
	function extract_img_to_string($str)
	{
		preg_match_all('/<img(.*)src(.*)=(.*)"(.*)"[^>]*?>/U', $str, $result);

		$foo = array_pop($result);

		if (empty($result[0])) {
			return false;
		}

		return ['TAG_IMG'=>$result[0],'POP_IMG'=>$foo];
	}
}

if (!function_exists("delete_img_to_string")) {
	function delete_img_to_string($arr_img,$str)
	{
		$foo = str_replace($arr_img,"<a href=''>[image]</a>", $str);
		return $foo;
	}
}

function sujetALaUneDeLaSemaine()	
{
	$current_week_start_date = Carbon\Carbon::now()->startOfWeek()->format('Y-m-d H:i:s');
	$current_week_end_date = Carbon\Carbon::now()->endOfWeek()->format('Y-m-d H:i:s');
	$current_week_interval = [$current_week_start_date,$current_week_end_date];

	$suject_valid = \App\Models\Sujet::whereActif(true)
									->whereBetween("created_at",$current_week_interval)
									//->where('nbcomment','!=',0)
									->orderBy('nbcomment','DESC')
									->limit(20)
									->get();

/*	$subjects = \DB::table('sujets')
					->join('reponses','subets.id','=','reponses.sujet_id')
					->select('sujets.*')
					->whereBetween('sujets.created_at',$current_week_interval)
					->orderBy('sujets.nbcomment','ASC')
					->limit(20)
					->get();*/

	return $suject_valid;
}

if (!function_exists("getAbsoluteClass")) {
 	function getAbsoluteClass($instance){
		$absolute_path = get_class($instance);
		$folder_container = explode("\\", $instance);
		$class = $folder_container[count($folder_container)-1];
		return $class;
	}
 }

 function storeErrors($exception)
 {
 	$error = new ErrorCapture();
    $error->code = $exception->getCode();
    $error->type = "ErrorException";
    $error->body = $exception->getMessage();
    $error->line = $exception->getLine();
    $error->file = get_class($exception);
    if(auth()->check()){
        $error->user_id = auth()->user()->id;
    }

    $error->url = \Request::url();

    $error->save();
 }

 
///calcule des pourcentage de progression des reaction(comments+likes)

if (!function_exists("pourcentage_de_reaction")) {
	function pourcentage_de_reaction($categorie_id){
		$t_comments = \App\Models\Reponse::all()->count();
		$t_likes = \App\Models\Like::all()->count();
		$t_replies = \App\Models\Reply::all()->count();

		$reponses = \DB::table('reponses')
            ->join('sujets','sujets.id','=','reponses.sujet_id')
            ->join('categories','categories.id','=',"sujets.categorie_id")
            ->where('sujets.categorie_id','=',$categorie_id)
            ->select('*')
            ->get();

        $likes = \DB::table('likes')
            ->join('sujets','sujets.id','=','likes.sujet_id')
            ->join('categories','categories.id','=',"sujets.categorie_id")
            ->where('sujets.categorie_id','=',$categorie_id)
            ->select('likes.id','likes.created_at')
            ->get();

        $replies = \DB::table('replies')
            ->join('reponses','reponses.id','=','replies.reponse_id')
            ->join('sujets','sujets.id','=','reponses.sujet_id')
            ->join('categories','categories.id','=',"sujets.categorie_id")
            ->where('sujets.categorie_id','=',$categorie_id)
            ->select('replies.id','replies.created_at')
            ->get();

        $nb_replies = count($replies);
        $nb_likes = count($likes);
        $nb_reponses = count($reponses);
		$pourcentage = 0;
		if(($t_comments+$t_likes+$t_replies) != 0)
        	$pourcentage = (($nb_reponses+$nb_likes+$nb_replies)/($t_comments+$t_likes+$t_replies))*100;
		


        return $pourcentage;
	}
}


?>