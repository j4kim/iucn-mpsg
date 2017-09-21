<!DOCTYPE html>
<html>
<head>
    <title>{{ $species->name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />

</head>
<body>
    <div class="not-printed explanations">
        <div class="container-fluid">
            <p>To generate a PDF file, simply <a href="javascript:window.print()">Open the print dialog</a> and select "Print to PDF" or equivalent.<br>
            <small><a href="{{ route("species.show", $species->id) }}">back</a></small></p>
        </div>
    </div>
    <div class="container-fluid">
        <h1>{{ $species->name }}</h1>
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
            @foreach ($species->maps as $img)
                <img class="species-map"
                     src="{{ imgUrl($img, 's') }}"
                     alt="{{ $img["title"] or "Location of " . $species->name }}"
                     title="{{ $img["title"] or "Location of " . $species->name }}">
            @endforeach
        </div>

        <main>
            {!! $species->data["Text"] !!}
        </main>

        <div class="gallery">
            <h2>Gallery</h2>
            <div class="image-gallery grid">
                <div class="grid-sizer"></div>
                @foreach ($species->images as $img)
                    <div class="grid-item">
                        <img src="{{ imgUrl($img, 's') }}" alt="{{ $img["title"] or $species->name }}">
                    </div>
                @endforeach
            </div>
            <div style="clear: both"></div>
        </div>

        @if($species->data["Additional References"] != "<p><br></p>")
            <div class="references ref-mobile">
                <h2 style="clear: both">Additional references</h2>
                {!! $species->data["Additional References"] !!}
            </div>
        @endif
    </div>
</body>
</html>