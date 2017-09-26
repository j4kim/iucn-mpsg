
<ul>
    @foreach($species as $s)
    <li>
        <a  href="{{ route('species.show', $s->id) }}">
            <i>{{$s->name}}</i>
        </a>
    </li>
    @endforeach
</ul>