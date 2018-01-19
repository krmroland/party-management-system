<h2>1. Budget</h2>
<table style="margin-bottom: 4px;">
    <thead>
        <tr>
            <th>No</th>
            <th>ITEM</th>
            <th>QTY</th>
            <th>UNIT COST</th>
            <th>TOTAL</th>
            <th>REMARKS</th>
        </tr>
    </thead>
        <tbody>
            @foreach ($budget as $key=>$category)
                <tr class="header">
                    <th class="text-center">{{ chr($key+65) }}.</th>
                    <th colspan="5">{{$category->name}}</th>
                </tr>
                @foreach ($category->items as $item)
                    <tr>
                        <td>{{++$loop->index}}.</td>
                        <td>{{$item->name}}</td>
                        <td>
                                {{ 
                                    !empty($item->qty)? 
                                    nf($item->qty) : 
                                    '--'
                                }} 
                                {{ $item->qtyUnits }}
                        </td>
                        <td>{{
                            !empty($item->qty)? 
                            nf($item->unitCost):
                            '--'
                        }}</td>
                        <td>{{nf($item->total)}}</td>
                        <td>{{$item->isCovered?'Covered':'-------------'}}</td>
                    </tr>
                @endforeach
            @endforeach
           

    </tbody>
    <tfoot>
        <tr>
            <th colspan="5">Totals</th>
            <th>{{ $budget_total }}</th>
        </tr>
    </tfoot>
</table>
