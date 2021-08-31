<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
</head>

<body class="antialiased">
    <div class="container mt-5">
        <h1>Chat </h1><br />
        <div class="mb-5 ">
            <ul class="list-group">
                {{-- <li class="list-group-item">A second item</li> --}}
            </ul>
        </div>
        <div class="mb-3 ">
            <label for="chat_text" class="form-label">Example label</label>
            <input type="text" class="form-control" id="chat_text" placeholder="Send Message">
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary float-end">Send</button>

        </div>
    </div>
</body>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<script src="https://cdn.socket.io/3.1.3/socket.io.min.js"
integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>

<script>
    // var socket = io();

    $(function() {
        let ip_address = '127.0.0.1';
        let socket_port = '3000';
        let socket = io(ip_address + ':' + socket_port);

        let chat_text_input = $('#chat_text');
        chat_text_input.keypress(function(e) {
            let message = $(this).val();
            console.log(message);
            if (e.which == 13 & !e.shiftKey) {
                socket.emit('sendMessageToServer', message);
                chat_text_input.val('');
                return false;
            }
        })

        socket.on('sendMessageToClient', (message) => {
            console.log(["sendMessageToClient", message]);
            $('.list-group').append(`<li class="list-group-item">${message}</li>`)
        });
    })
</script>

</html>
