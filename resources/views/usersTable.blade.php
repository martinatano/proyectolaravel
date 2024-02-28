<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}>

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
                        <td> <button class="btn btn-primary" onclick="redirect('{{$user->login}}')">Ver mas informacion</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userDetailsModalLabel">User details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="userDetailsModalBody" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        </div>
        <script>
            function redirect(login){
               const body = {username: login};
               $.ajax({
                method: 'POST',
                url: '/userDetails',
                headers: {
                    'X-CSRF-TOKEN':document.getElementsByTagName('meta')[2].content,
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify(body)
                success: (response) => {
                        $("#userDetailsModal").modal({show: true});
                        const parsedResponse = JSON.parse(response);

                        const avatarUrl = parseResponse.avatar_url ?? 'does not specify';
                        const createdAt = new Date(parsedResponse.created_at).toLocaleDateString("es-AR") ?? 'does not specify';
                        const company = parsedResponse.company ?? 'does not specify';
                        const email = parsedResponse.email ?? 'does not specify';
                        const followes = parsedResponse.followers ?? 'does not specify';
                        const following = parsedResponse.following ?? 'does not specify';
                        const location = parsedResponse.location ?? 'does not specify';
                        const login = parsedResponse.login ?? 'does not specify';
                        const name = parsedResponse.name ?? 'does not specify';

                        const table = `<h1>${name}</h1>`
                                   
                        
                        
                },
                error:(data){
                    alert(data);
                }
               })
            }
        </script>
    </body>
</html>
