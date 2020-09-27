@if ( isset($sort_disable) )
    <thead>
    <tr>
        <th colspan="2">UFR Files</th>
        <th class="d-none d-md-block">S/P</th>
        <th>Price</th>
        <th class="date d-none d-md-block">Date</th>
        <th class="size">Size </th>
    </tr>
    </thead>
@else
    <thead>
<tr>
    <th colspan="2"><a href="{{ $urlForSort }}&sortBy=name&direction=@if ( $sortBy == 'name')@if ($direction == 'asc' ){{'desc'}} @else{{'asc'}} @endif @endif">UFR Files
            @if ( $sortBy == 'name')
                @if ($direction == 'asc' )<i class="fa fa-angle-up" aria-hidden="true"></i>
                @else <i class="fa fa-angle-down" aria-hidden="true"></i>
                @endif
            @endif
        </a>
    </th>
    <th  class="d-none d-md-block"><span style="color: #ffbd9b;">Categories</span></th>
    <th class="d-none d-md-block"><a href="{{ $urlForSort }}&sortBy=seeders&direction=@if ( $sortBy == 'seeders'
    )@if ($direction == 'asc' ){{'desc'}}
        @else{{'asc'}}
        @endif
        @endif">
            S/P
            @if ( $sortBy == 'seeders')
                @if ($direction == 'asc' )<i class="fa fa-angle-up" aria-hidden="true"></i>
                @else <i class="fa fa-angle-down" aria-hidden="true"></i>
                @endif
            @endif
        </a>
    </th>
    <th><a href="{{ $urlForSort }}&sortBy=price&direction=@if ( $sortBy == 'price'
    )@if ($direction == 'asc' ){{'desc'}}
        @else{{'asc'}}
        @endif
        @endif">
            Price
            @if ($sortBy == 'price')
                @if ($direction == 'asc' )
                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                @else
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                @endif
            @endif
    </th>
    <th class="date d-none d-md-block"><a href="{{ $urlForSort }}&sortBy=date&direction=@if ( $sortBy == 'date'
    )@if ($direction == 'asc' ){{'desc'}}
        @else{{'asc'}}
        @endif
        @endif">Date @if ( $sortBy == 'date')
            @if ($direction == 'asc' )<i class="fa fa-angle-up" aria-hidden="true"></i>
            @else <i class="fa fa-angle-down" aria-hidden="true"></i>
            @endif
            @endif
            </a>
    </th>
    <th class="size"><a href="{{ $urlForSort }}&sortBy=size&direction=@if ( $sortBy == 'size'
    )@if ($direction == 'asc' ){{'desc'}}
        @else{{'asc'}}
        @endif
        @endif">Size @if ( $sortBy == 'size')
                @if ($direction == 'asc' )<i class="fa fa-angle-up" aria-hidden="true"></i>
                @else <i class="fa fa-angle-down" aria-hidden="true"></i>
                @endif
            @endif
        </a>
    </th>
</tr>
</thead>
<tbody>


@endif
