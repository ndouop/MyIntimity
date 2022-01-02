
<div class="form-group form-float form-group-sm">
    <div class="form-line">
        <input type="text" class="form-control" name="label" required>
        <label class="form-label">Libelle *</label>
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('categories.index') !!}" class="btn btn-default">Cancel</a>
</div>
