<!-- Login Field -->
<div class="form-group col-sm-6">
    {!! Form::label('login', 'Login:') !!}
    {!! Form::text('login', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Actif Field -->
<div class="form-group col-sm-6">
    {!! Form::label('actif', 'Actif:') !!}
    {!! Form::number('actif', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Langue Field -->
<div class="form-group col-sm-6">
    {!! Form::label('langue', 'Langue:') !!}
    {!! Form::text('langue', null, ['class' => 'form-control']) !!}
</div>

<!-- Remember Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
</div>

<!-- Paramettre Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paramettre_id', 'Paramettre Id:') !!}
    {!! Form::number('paramettre_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Tel1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tel1', 'Tel1:') !!}
    {!! Form::text('tel1', null, ['class' => 'form-control']) !!}
</div>

<!-- Tel2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tel2', 'Tel2:') !!}
    {!! Form::text('tel2', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prenom', 'Prenom:') !!}
    {!! Form::text('prenom', null, ['class' => 'form-control']) !!}
</div>

<!-- Sexe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sexe', 'Sexe:') !!}
    {!! Form::text('sexe', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar', 'Avatar:') !!}
    {!! Form::text('avatar', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Naissance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_naissance', 'Date Naissance:') !!}
    {!! Form::date('date_naissance', null, ['class' => 'form-control']) !!}
</div>

<!-- Pay Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pay_id', 'Pay Id:') !!}
    {!! Form::number('pay_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Region Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('region_id', 'Region Id:') !!}
    {!! Form::number('region_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Ville Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ville_id', 'Ville Id:') !!}
    {!! Form::number('ville_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Addresse Detaille Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('addresse_detaille', 'Addresse Detaille:') !!}
    {!! Form::textarea('addresse_detaille', null, ['class' => 'form-control']) !!}
</div>

<!-- Couverture Field -->
<div class="form-group col-sm-6">
    {!! Form::label('couverture', 'Couverture:') !!}
    {!! Form::text('couverture', null, ['class' => 'form-control']) !!}
</div>

<!-- Bp User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bp_user', 'Bp User:') !!}
    {!! Form::text('bp_user', null, ['class' => 'form-control']) !!}
</div>

<!-- Ddr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ddr', 'Ddr:') !!}
    {!! Form::date('ddr', null, ['class' => 'form-control']) !!}
</div>

<!-- Duree Ecoulement Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duree_ecoulement', 'Duree Ecoulement:') !!}
    {!! Form::number('duree_ecoulement', null, ['class' => 'form-control']) !!}
</div>

<!-- Duree Cycle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duree_cycle', 'Duree Cycle:') !!}
    {!! Form::number('duree_cycle', null, ['class' => 'form-control']) !!}
</div>

<!-- Heure Notification Field -->
<div class="form-group col-sm-6">
    {!! Form::label('heure_notification', 'Heure Notification:') !!}
    {!! Form::text('heure_notification', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
