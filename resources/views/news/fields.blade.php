<!--- Title Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!--- Summary Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('summary', 'Summary:') !!}
    {!! Form::text('summary', null, ['class' => 'form-control']) !!}
</div>

<!--- Full News Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('full_news', 'Full News:') !!}
    {!! Form::text('full_news', null, ['class' => 'form-control']) !!}
</div>

<!--- Publication Date Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('publication_date', 'Publication Date:') !!}
    {!! Form::text('publication_date', null, ['class' => 'form-control']) !!}
</div>

<!--- Author Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('author', 'Author:') !!}
    {!! Form::text('author', null, ['class' => 'form-control']) !!}
</div>

<!--- Enable Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('enable', 'Enable:') !!}
    {!! Form::text('enable', null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
