<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                        <td> <button class="btn btn-primary" onClick="redirect('{{$user->login}}')">Ver mas informacion</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="display: flex; justify-content: center; align-items:center">
    <div class="modal-content" style="width: fit-content;">
      <div class="modal-header">
        <h5 class="modal-title" id="userDetailsModalLabel">User details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="userDetailsModalBody" class="modal-body text center">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function redirect(login){
               const body = {username: login};
               $.ajax({
                method: 'POST',
                url: '/userDetails',
                headers: {
                    'X-CSRF-TOKEN':document.getElementsByTagName("meta")[2].content,
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify(body),
                success: (response) => {
                    $('#userDetailsModalBody').empty();
                        $("#userDetailsModal").modal({show: true});
                       const parsedResponse = JSON.parse(response);

                        const avatarUrl = parsedResponse.avatar_url ?? 'does not specify';
                        const createdAt = new Date(parsedResponse.created_at).toLocaleDateString("es-AR") ?? 'does not specify';
                        const company = parsedResponse.company ?? 'does not specify';
                        const email = parsedResponse.email ?? 'does not specify';
                        const followes = parsedResponse.followers ?? 'does not specify';
                        const following = parsedResponse.following ?? 'does not specify';
                        const location = parsedResponse.location ?? 'does not specify';
                        const login = parsedResponse.login ?? 'does not specify';
                        const name = parsedResponse.name ?? 'does not specify';

                        const table = `<table>
                                            <tbody>
                                                <tr>
                                                <th>Avatar</th>
                                                <th>Created at</th>
                                                <th>Company</th>
                                                <th>Email</th>
                                                <th>Followers</th>
                                                <th>Following</th>
                                                <th>Location</th>
                                                <th>Username</th>
                                                <th>Name</th>
                                                </tr>
                                                <tr>
                                                    <td><img src="${avatarUrl}" alt="avatar image" width="100" height="100"></td>
                                                    <td><p>${createdAt}</p></td>
                                                    <td><p>${company}</p></td>
                                                    <td><p>${email}</p></td>
                                                    <td><p>${followes}</p></td>
                                                    <td><p>${following}</p></td>
                                                    <td><p>${location}</p></td>
                                                    <td><p>${login}</p></td>
                                                    <td><p>${name}</p></td>
                                                </tr>
                                            </tbody>
                                        </table>`;
                                        $('#userDetailsModalBody').append(table);
                                         
                },
                error:(response) =>{
                    Swal.fire({
                        title: "The Internet?",
                        text: "That thing is still around?",
                        icon: "question"
});
                }
               })
            }
        </script>
    </body>
</html>
