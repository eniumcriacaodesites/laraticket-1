{!! Former::select('client_id','Client')->options($formOptions['client']) !!}
{!! Former::text('title','Title') !!}
<div class="row">
    <div class="col-sm-6">
        {!! Former::select('status_id','Status')->options($formOptions['statuses']) !!}
    </div>
    <div class="col-sm-6">
        @if($update)
        {!! Former::select('priority','Priority')->options($formOptions['priorities']) !!}
        @else
        {!! Former::select('priority','Priority')->options($formOptions['priorities'])->value(5) !!}
        @endif
    </div>
</div>
{!! Former::textarea('description','Description') !!}

@if(isset($formOptions['users']))
    {!! Former::hidden('updateAssignedUsers',true) !!}
    {!! Former::multiselect('assignedUsers')->options($formOptions['users'])->addClass('chosen-select')->setAttribute('data-placeholder','Select assigned users') !!}
@endif