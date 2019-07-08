<div class="btn-group">
    <button type="button" class="btn btn-xs dropdown-toggle" 
    :class="{{$data}}.status == 'Open' ? 'blue' : {{$data}}.status == 'Approved' ? 'yellow' : {{$data}}.status == 'Canceled' ? 'red': 'dark'" data-toggle="dropdown"> {{output(<?= $data ?>.status)}}
        <i class="{{$icon}}"></i>
    </button>
    <ul class="dropdown-menu pull-right" role="menu">
        <li :class="{{$data}}.status == 'Open' ? 'active' : ''">
            <a v-on:click.prevent="{{$data}}.status != 'Open' ? {{$func}}({{isset($index) && !$index ? "" : "index,"}} 'Open') : ''">
                <i class="fa fa-envelope-open"></i> Open</a>
        </li>
        <li :class="{{$data}}.status == 'Approved' ? 'active' : ''">
            <a v-on:click.prevent="{{$data}}.status != 'Approved' ? {{$func}}({{isset($index) && !$index ? "" : "index,"}} 'Approved') : ''">
                <i class="fa fa-check"></i> Approved</a>
        </li>
        <li class="divider"> </li>
        <li :class="{{$data}}.status == 'Canceled' ? 'active' : ''">
            <a v-on:click.prevent="{{$data}}.status != 'Canceled' ? {{$func}}({{isset($index) && !$index ? "" : "index,"}} 'Canceled') : ''">
                <i class="fa fa-ban"></i> Canceled</a>
        </li>
        <li :class="{{$data}}.status == 'Closed' ? 'active' : ''" v-show="{{isset($closed) ? $closed : true}}">
            <a v-on:click.prevent="{{$data}}.status != 'Closed' ? {{$func}}({{isset($index) && !$index ? "" : "index,"}} 'Closed') : ''">
                <i class="fa fa-times"></i> Closed</a>
        </li>
    </ul>
</div>