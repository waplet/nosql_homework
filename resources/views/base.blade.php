<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

        <title>NoSQL</title>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-inverse">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ URL::to('project') }}">Nerd Alert</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('project') }}">View All Nerds</a></li>
                    <li><a href="{{ URL::to('project/create') }}">Create a Nerd</a></li>
                </ul>
            </nav>
            <div class="content">
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </body>
</html>
