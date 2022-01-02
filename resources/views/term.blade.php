@extends('discution.template')

@section('css')
    {{HTML::style('css/styleCondition.css')}}
    <style>
        .center{
            text-align: center;
        }
    </style>
@stop

@section('content')

    <br><br><br>

    <div class="container">
        <h2 class="">{!! Lang::get('string.term') !!}</h2>
    </div>
    <div class="container">
        <section class="box-typical contacts-page" style="">

            <div class="row">

                <div class="col-lg-2  col-md-2 col-sm-2 col-xs-12">
                    &nbsp;
                </div><!--.col- -->

                <div class="col-lg-8  col-md-8 col-sm-8 col-xs-12">
                    <br><br>
                    <p class="bloc-term-text">
                        Les présentes {!! Lang::get('string.term') !!} constituent des règles d’utilisation de l’application
                        (Web et mobile) {!! Lang::get('string.app_name') !!}. L’inscription et la navigation emportent leur entière acceptation et
                        votre engagement de les respecter.
                    </p>
                    <p class="bloc-term-text">
                        Les présentes {!! Lang::get('string.term') !!} sont consultables en permanence sur le Site et
                        demeurent propriété exclusive de la société Vision Numerique, dont le siège social
                        se trouve à Yaoundé au Cameroun. <br>
                        La Société a le droit de modifier les {!! Lang::get('string.term') !!}, et cela de manière
                        unilatérale, sans préavis et à tout moment, en publiant une nouvelle version des {!! Lang::get('string.term') !!} sur le Site. Les Utilisateurs seront avisés par tout moyen de la nouvelle
                        version et le fait pour les Utilisateurs de continuer à utiliser l’application après l’information
                        sur une modification des {!! Lang::get('string.term') !!} constitue l’acceptation tacite et
                        sans réserve de ces dernières.

                    </p>
                    <h3 class="bloc-term-title"> Utilisation de l’application </h3>
                    <h5 class="bloc-term-title"> Visite du site </h5>
                    <p class="bloc-term-text">
                        Le Site peut être visité par toute personne, sans obligation d’inscription. Néanmoins, les
                        personnes non inscrites ne peuvent pas poster des sujets ni apporter leur réponse à un sujet.
                        Toute personne visitant le Site est tenue de respecter les présentes {!! Lang::get('string.term') !!},
                        les lois et règlements en vigueur ainsi que les droits de tiers, notamment les
                        droits de la propriété intellectuelle.

                    </p>
                    <h5 class="bloc-term-title"> Inscription </h5>
                    <p class="bloc-term-text">
                        En s’inscrivant sur l’application, l’Utilisateur déclare avoir pris connaissance des présentes
                        {!! Lang::get('string.term') !!}. La création d’un Compte vaut donc acceptation de ces dernières
                        sans restriction ni réserve. <br>
                        A la création d’un Compte, l’Utilisateur choisit un email et un mot de passe lui permettant de
                        se connecter à son Compte sur l’application. Ces identifiants sont strictement personnels et
                        confidentiels et l’Utilisateur s’engage à ne pas les communiquer aux tiers. L’Utilisateur est
                        seul responsable de l’utilisation de ses identifiants par des tiers et des opérations effectuées
                        avec l’utilisation de ses identifiants.


                    </p>
                    <h5 class="bloc-term-title"> Gestion du cycle menstruel </h5>
                    <p class="bloc-term-text">
                        L’application web ou mobile {!! Lang::get('string.app_name') !!} est simplement un outil d’aide au calcul qui vous permet de
                        déterminer les périodes des règles et féconde de votre cycle menstruel. Il se base sur le
                        principe d’une méthode de contraception dit des jours fixes (MJF) ou du calendrier. C’est une
                        méthode qui selon plusieurs sources fonctionne à environ 95%. {!! Lang::get('string.app_name') !!} n’est qu’un programme
                        informatique et donc produit les résultats sur la base des paramètres reçus. Il est donc de
                        votre responsabilité de définir les bons paramètres de calculs afin d’avoir des meilleurs
                        résultats. Certains facteurs (infections, stress, nuits courtes…) peuvent perturber votre cycle
                        et ainsi augmenter ou diminuer la durée, {!! Lang::get('string.app_name') !!} ne fait des estimations que sur une durée
                        connue au préalable. Nous vous conseillons de réinitialiser vos paramètres à chaque début réel
                        (premier jour des règles) du cycle.


                    </p>
                    <h5 class="bloc-term-title"> Charte de forum </h5>
                    <p class="bloc-term-text">
                        Le forum est un lieu d’expression ouvert à tous et à toutes. Vous êtes invités à vous y exprimer
                        librement dans le respect des opinions et des droits de chacun. <br>
                        Cet espace d’expression vous propose de poster,  débattre et d’échanger sur les sujets  proposés
                        par les utilisateurs. Vous pouvez si vous le souhaitez prendre connaissance des messages ou
                        participer à l’échange en vous inscrivant.  Les données vous concernant que vous nous transmettrez
                        ne seront utilisées que pour assurer le fonctionnement des services du site. Elles ne seront en
                        aucun cas transmises à des tiers sans votre autorisation préalable, sauf exigences légales. Vous
                        devez utiliser un login, il vous plaira de choisir dans le respect des règles suivantes : sont
                        interdits les logins relevant de l’insulte de l’injure, évoquant des propos, situations ou
                        pratiques obscènes, grossières, à caractère sexuel ou attentatoire à la dignité humaine ou aux
                        bonnes mœurs. Sont également prohibés les pseudonymes pouvant entraîner un risque de confusion
                        dans l’esprit du public quant à l’auteur du message ou à sa qualité ou qualification, ainsi que
                        ceux faisant référence directement ou indirectement à un signe commercial protégé que l’utilisation
                        du pseudonyme soit ou non dénigrante . <br>
                        Vous disposez d'un droit d'accès, de modification, de rectification et de suppression des
                        données qui vous concernent. Vous pouvez, à tout moment, demander que vos contributions à
                        cet espace de discussion soient supprimées. Les demandes concernant le droit d’accès, de
                        modification et de rectification doivent être adressées par courrier,  accompagné d’un
                        justificatif d’identité à la personne ou au service en charge du droit d'accès et de
                        rectification. <br>
                        La participation au forum est libre mais en vous inscrivant ou en vous connectant et contribuant
                        par l’envoi d’un message, vous reconnaissez avoir pris connaissance et accepter les
                        {!! Lang::get('string.term') !!} du forum. <br>
                        Lorsque vous postez un message celui-ci est susceptible d’être lu par un grand nombre de
                        personnes, voire l’ensemble des internautes, cet acte d’édition peut engager votre responsabilité
                        personnelle, il convient donc d’être prudent et mesuré. <br>
                        Les contributions que vous postez dans le forum doivent être en relation avec les thèmes de
                        discussion proposés. <br>

                    </p>
                    <h5 class="bloc-term-title"> Forum modéré a posteriori </h5>
                    <p class="bloc-term-text">
                        Ce forum est modéré a posteriori, les messages que vous postez sont directement publiés sans
                        aucun contrôle préalable. Il est de votre responsabilité de veiller à ce que vos contributions
                        ne portent pas préjudice à autrui et soient conforment à la réglementation en vigueur. Les
                        organisateurs du forum et les modérateurs se réservent le droit de retirer toute contribution
                        qu’ils estimeraient déplacée, inappropriée, contraire aux lois et règlements, à cette charte
                        d’utilisation ou susceptible de porter préjudice directement ou non à des tiers. <br>
                        Les messages qui ne sont pas en relation avec les thèmes de discussion ou avec l’objet du forum
                        peuvent être supprimés sans préavis par les modérateurs. Seront aussi supprimées, sans préjudice
                        d'éventuelles poursuites disciplinaires ou judiciaires, les contributions qui : <br>

                    </p>
                    <ul>
                        <ol>
                            incitent à la discrimination fondée sur la race, le sexe, la religion, à la haine, à la
                            violence, au racisme ou au révisionnisme.
                        </ol>
                        <ol>
                            incitent à la commission de délits.
                        </ol>
                        <ol>
                            sont contraire à l'ordre public et aux bonnes mœurs,
                        </ol>
                        <ol>
                            font l’apologie des crimes ou délits et particulièrement du meurtre, viol, des crimes de
                            guerre et crimes contre l'humanité,
                        </ol>
                        <ol>
                            ont un caractère injurieux, diffamatoire, insultant ou grossier
                        </ol>
                        <ol>
                            portent manifestement atteinte aux droits d’autrui et particulièrement ceux qui portent
                            atteinte à l'honneur ou à la réputation d'autrui,
                        </ol>
                        <ol>
                            sont liés à un intérêt manifestement commercial ou ont un but promotionnel sans objet avec
                            le forum.
                        </ol>
                    </ul>

                    <p class="bloc-term-text">
                        L’utilisation d’un pseudonyme ne rend pas anonyme, les prestataires techniques sont tenus de
                        conserver et de déférer à l’autorité judiciaire les informations de connections (log, IP, date/heure)
                        permettant la poursuite de l’auteur d’une infraction. Toutes les informations nécessaires seront
                        donc conservées pour la durée légale prévue. Elles seront détruites au terme du délai légal de
                        conservation.
                    </p>
                    <p class="bloc-term-text">
                        Les organisateurs du forum se réservent le droit d’exclure du forum, de façon temporaire ou
                        définitive, toute personne dont les contributions sont en contradiction avec les règles
                        mentionnées dans le présent document. Les organisateurs pourront transmettre aux autorités de
                        police ou de justice toutes les pièces ou documents postés sur le forum s’ils estiment de leur
                        devoir d’informer les autorités compétentes ou que la législation leur en fait obligation.
                    </p>

                    <h5 class="bloc-term-title"> Responsabilité de l’application </h5>
                    <p class="bloc-term-text">
                        La Société n’est pas responsable en cas d’un quelconque litige qui peut survenir entre les
                        Utilisateurs du Site, quelle qu’en soit la cause, y compris lorsque le litige est en relation
                        avec l’utilisation du Site. <br>
                        Ainsi, en cas de litige entre des Utilisateurs, la Société ne peut être contactée que pour aider
                        à établir l’identité de la personne contre qui vous souhaitez agir.


                    </p>
                    <br><br><br>
                </div><!--.col- -->

                <div class="col-lg-2  col-md-2 col-sm-2 col-xs-12">
                    &nbsp;
                </div><!--.col- -->
        </div>
    </div>

@endsection


@section('scripts')

@stop

