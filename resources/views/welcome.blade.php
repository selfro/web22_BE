<!DOCTYPE html>
<html lang="de">
    <head>
               <title>Laravel</title>

    </head>
    <body>
        <ul>
            @foreach($offers as $offer)

                <li>{{$offer->user_id}}</li>
                <li>{{$offer->lva_id}}</li>
                <br>
            @endforeach
        </ul>
    </body>
</html>
