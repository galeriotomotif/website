<div id="datatables-filters">
</div>
<table class="table display responsive nowrap w-100" data-datatables-structure-url="{{route($route.'datatables.structure')}}" id="datatables">
    <thead>
        <tr>
            @foreach ($datatablesStructure['collumns'] as $item)
                <td>
                    {{$item['label']}}
                </td>
            @endforeach
        </tr>
    </thead>
</table>
