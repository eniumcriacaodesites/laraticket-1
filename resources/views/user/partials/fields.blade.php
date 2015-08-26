{!! Former::email('email','Email Address') !!}
@if(!$update)
{!! Former::password('password','Password') !!}
@else
{!! Former::password('password','Password')->placeholder('Leave blank to keep existing') !!}
@endif