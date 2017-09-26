<div class="id{{ $species->id }}">
    <h1 class="species-header break-before">{{ $species->name }}</h1>
    <div class="summary">
        <h2>Summary</h2>
        <table class="table table-condensed">
            <tbody>
            <?php $summary = $species->data["Summary"]; ?>
            <tr>
                <th>Latin name</th>
                <td><strong><em>{{ $summary['Latin name']['Name'] }}</em></strong> {{ $summary['Latin name']['Author'] }}</td>
            </tr>
            @if(isset($summary['Synonym']))
                <tr>
                    <th>Synonym</th>
                    <td><strong><em>{{ $summary['Synonym']['Name'] }}</em></strong> {{ $summary['Synonym']['Author'] }}</td>
                </tr>
            @endif
            @if(isset($summary['Common name']))
                <tr>
                    <th>
                        {{-- Plural if there ara multiple common names -> ie. ther is a semicolon --}}
                        @if(strpos($summary["Common name"],';'))
                            Common names
                        @else
                            Common name
                        @endif
                    </th>
                    <td><strong>{{ $summary['Common name'] }}</strong></td>
                </tr>
            @endif
            @if(isset($summary['Family']))
                <tr>
                    <th>Family</th>
                    <td><strong>{{ $summary['Family'] }}</strong></td>
                </tr>
            @endif
            @if(isset($summary['Status']))
                <tr>
                    <th>Status</th>
                    <td><strong>{{ $summary['Status'] }}</strong></td>
                </tr>
            @endif
            <tr>
                @if(count($species->islands) === 1)
                    <th>Island</th>
                @else
                    <th>Islands</th>
                @endif
                <td>
                    <ul class="island-list">
                        @foreach($species->islands as $isl)
                            <li><strong>{{ $isl->name }}</strong> ({{ $isl->country }})</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="maps">
            @foreach ($species->maps as $img)
                <figure>
                    <img class="species-map"
                         src="{{ imgUrl($img, 's') }}"
                         alt="{{ $img["title"] or "Location of " . $species->name }}"
                         title="{{ $img["title"] or "Location of " . $species->name }}">
                    <figcaption>
                        {{ $img["title"] }}
                        @if ($img["legend"])
                            | <small>{{ $img["legend"] }}</small>
                        @endif
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>

    @foreach ($species->images as $img)
        <figure class="species-image">
            <img src="{{ imgUrl($img, 's') }}" alt="{{ $img["title"] or $species->name }}">
            <figcaption>
                {{ $img["title"] }}
                @if ($img["legend"])
                    – <small>{{ $img["legend"] }}</small>
                @endif
            </figcaption>
        </figure>
    @endforeach

    <main>
        {!! $species->data["Text"] !!}
    </main>

    @if($species->data["Additional References"] != "<p><br></p>")
        <div class="references ref-mobile">
            <h2>Additional references</h2>
            {!! $species->data["Additional References"] !!}
        </div>
    @endif

    <div style="clear:both;"></div>

</div>

<script>
    $(function(){
        var _2eH2 = $(".id" + {{ $species->id }} + " main h2")[1];
        var photos = $(".id" + {{ $species->id }} + " .species-image");
        photos.insertAfter(_2eH2);
    });
</script>