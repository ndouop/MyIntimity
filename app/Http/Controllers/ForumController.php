<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sujet;
use App\Models\Categorie;

class ForumController extends Controller
{
	private $CATEGORIE = [];

    public function __construct()
    {
    	//$this->middleware('auth');
    }

    public function index(Request $request)
    {
        /**
        *
        *Il est a noté que cette methode gere une vue avec affichage du contenu different
        *si la categorie est passée comme paramettre alors, elle chargera les sujet par
        *categorie
        *sinon elle chargera les sujets nouvellement ajoutés par les participant
        **/

    	if (is_null($request->all())) {
    		return back()->withError(trans("back/forum.a_cat_most_by_select"));
    	}

    	$sujets = Sujet::whereActif(true)
    					->orderBy('created_at','DESC');
        $categories = Categorie::all();

    	if ($request->categorie=='all') {
    					$sujets = $sujets;
    	}
        elseif (!isset($request->categorie) || is_null($request->categorie)) {
            //ici on est dans les page d'accueil principale
            $new_subjects = $sujets->paginate(20);
            $compacted = array(
                    'categories'=>$categories,
                    'sujets'=>$new_subjects,
                    'by_categorie'=>false
                );

        }
        else{
            //sinon

            $sujets = $sujets->whereCategorieId($request->categorie);     
            $sujets = $sujets->paginate(15);
            $compacted = array(
                    'categories'=>$categories,
                    'sujets'=>$sujets,
                    'categorie_selected'=>$request->categorie,
                    'by_categorie'=>true
                );
    	}
        
    	return view('discution.welcome.index',$compacted);
    }

    public function choiceCategorie($cat)		
    {
    	return redirect("forum?categorie=$cat");
    }
}
