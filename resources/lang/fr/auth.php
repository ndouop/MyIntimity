<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'Courriel et/ou mot de passe invalide',
    'throttle' => 'Veuillez réessayer dans :seconds secondes.',
    'initpwd_titre' => 'Réinitialiser le mot de passe',
    'email' => 'Email.',
    'send_link' => 'Envoyer le lien.',
    'pwd_conf' => 'Confirmer le mot de passe',
    'reset' => 'Réinitialiser',
    'pwd' => 'mot de passe.',
    'link' => 'Cliquer pour réinitialiser le mot de passe ',
    "email"=>[
        "register"=>[
            "thk_confiance"=>"Merci pour votre confiance!",
            "myintimity_slog"=>"MyIntimity est une application application d'aide à la gestion du cycle menstruel de la femme avec forum anonymé.",
            "y_param"=>"Vos Paramètres",
            "y_login"=>"Votre login",
            "y_pwd"=>"Votre mot de passe",
            "link_text_cycle"=>"Simplifiez-vous la vie et gagnez en temps, calculez automatiquement votre",
            "link_val_cycle"=>"cycle menstruel",
            "txt1"=>"se charge de tous et vous notifie pendant les periodes fecondes et des regles.",
            "txt2"=>"Vous pouvez poser n'importe quelle question",
            "txt3"=>"Toute la communauté :app_name est là pour vous. Posez votre problème sans tabou, ni honte sur votre",
            "txt4"=>"Vous pouvez rester anonymes si vous le désirez.",
            "txt5"=>"Partagez et soutenez le projet",
            "txt6"=>"Soyez le premier à faire decouvrir :app_name à vos amis ou vos proches, partagez sur tous les reseaux sociaux, invitez vos amis, ect. :app_name a plus que jamais besoin de votre soutien pour evoluer.",
            "cond"=>"Condition",
            "confid"=>"Politique de confidentialité",
            "pol_donn"=>"Politique de données",
            "txt10"=>""
        ]
    ],
    "login"=>[
        "conn_with_fck"=>"connextion par Facebook",
        "conn_with_ggle"=>"connextion par Google",
        'msg'=>"Connectez-vous pour démarrer votre session",
        "rememberme"=>"Se souvenier de moi",
        "create_account_now"=>"Créer votre compte maintenant",
        "label"=>[
            "login"=>"Login ou E-mail",
            "pwd"=>"Mot de passe"
        ],
        "btnSubmit"=>"se connecter"
    ],
    "register"=>[
        "reg_with_fck"=>"enregistrez vous par Facebook",
        "reg_with_ggle"=>"enregistrez vous par Google",
        'msg'=>"Devenez membre",
        "label"=>[
            "login"=>"Login ou E-mail",
            "pwd"=>"Mot de passe",
            "cpwd"=>"confirmez le mode de passe",
            "email"=>"Votre adresse e-mail"
        ],
            "agree_cond"=>'j\'ai lu et j\'accepte les  <a href="'.route("term").'">conditions d\'utilisations</a>.',
            "btn"=>"s'enregistrer",
            "membership"=>"Vous êtez déjà membre?"
    ],
    "password"=>[
        "email"=>[
            "title"=>"Réinitialisation mot de passe",
            "y_email"=>"Entrer l'email pour réinitialiser le mot de passe",
            "label"=>"Votre E-mail... ",
            "btn"=>"Réinitialiser"
        ],
        "reset"=>[
            "title"=>"Réinitialiser le mot de passe",
            "msg"=>"Changer votre mot de passe en remplissant les champs",
            "label"=>[
                "pwd"=>"Mot de passe",
                "cpwd"=>"confirmez le mode de passe",
                "email"=>"Votre adresse e-mail"
            ],
            "btn"=>"Réinitialiser"
        ]
    ]
];
