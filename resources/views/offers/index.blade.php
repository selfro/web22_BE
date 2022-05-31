<!DOCTYPE html>
<html lang="de">
<head>
    <title>Laravel</title>

</head>
<body>
<ul>
    @foreach($offers as $offer)
        <li><a href="offers/{{$offer->id}}">Angebot
                {{$offer->id}}</a></li>
    @endforeach

</ul>
</body>
</html>
