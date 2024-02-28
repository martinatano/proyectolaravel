<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            html, body{
                background color: white;
                color: grey;
                font-weight:200;
                height:100vh;
                margin:0
            }

            table, th, td{
                border:1px solid black;

            }
        </style>
    </head>
    <body>
       <div style="height:100vh; margin: 3rem; display:grid; place-items:center">
            <table>
                <tbody>
                    <tr>
                        <th>Avatar</th>
                        <th>name</th>
                    </tr>
                    @foreach ($users as $user)
                    <tr>
                        <td> <img src="{{$user->avatar_url}}" alt="user avatar" width="100" height="100"></td>
                        <td><p>{{$user->login}}</p></td>
                        <td><a href="/eliminarUsuario/{{$user->id}}/{{$user->login}}">Ir a otra pagina</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
