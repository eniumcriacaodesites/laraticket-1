{!! Former::text('name','Name') !!}
{!! Former::text('weight','Weight') !!}
{!! Former::hidden('updateBillable',true) !!}
{!! Former::checkbox('billable','')->text('Billable') !!}
{!! Former::hidden('updateArchivable',true) !!}
{!! Former::checkbox('archivable','')->text('Archivable') !!}