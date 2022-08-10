<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <h1 style="text-align: center;">Users</h1>
    <hr>
    <div style="margin: 2%">
        @if(session('success'))
                        <div>{{ session('success') }}</div>
                    @endif

        <form enctype="multipart/form-data" method="POST" action="{{ route('send.email') }}" class="form-horizontal mt-4">
            @csrf
    <table class="table table-borderless">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Email</th>
            <th scope="col">Send Email</th>
          </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td> <button onclick="SendEmail('{{$user->email}}')" type="button" class="btn waves-effect waves-light btn-danger">Send</button></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </form>
    </div>
    
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

        <script>
            function SendEmail(email) {
                console.log(email)
                swal({
                    title: "Warning",
                    text: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    buttons: ["No", "Yes"],
                })
                    .then((willSend) => {
                        if (willSend) {
                            $.ajax({
                                url: "{{ route('send.email') }}",
                                data: { "_token": "{{ csrf_token() }}", email:email },
                                type: "POST",
                                success: function (data) {
                                    if(data==="ok"){
                                        swal("Success!", "Email Sent!", "success");
                                        window.setTimeout(function(){location.reload()},2000)
                                    }else{
                                        swal("Error!", "Email didn't sent!", "error");
                                    }
                                },
                                error: function (x, sts) {
                                    console.log("Error...");
                                    console.log('no');
                                },
                            });
                        } else {
                            swal("Cancelled!");
                        }
                    });
            }
        </script>

</body>