
<ul>
    @forelse($species as $s)
    <li>
        <a  href="{{ route('species.show', $s->id) }}">
            <i>{{$s->name}}</i>
        </a>
    </li>
    @empty
        <li>No species</li>
    @endforelse
</ul>