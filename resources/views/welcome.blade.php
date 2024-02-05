<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <style>
        li {
            margin-right: 10px
        }
        ul{
            display: flex; list-style:none;
        }
        button{
            margin-right: 5px !important
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body class="antialiased">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    To Do list
                </div>
                <div class="card-body">
                    <form action="{{ route('create') }}" id="postform">
                        @csrf
                        <label for="name">Name</label>
                        <input type="text" name="name">
                        <label for="mobile">Mobile</label>
                        <input type="number" name="mobile">
                        <Button type='submit' class="postbutton">Submit</Button>
                    </form>
                </div>
            </div>
            <div class="card">
                <ul style="display: flex; list-style:none;">
                    <li>Sr.</li>
                    <li>Name</li>
                    <li>Mobile</li>
                </ul>
                @if ($results)

                <div class="listdata">
                @foreach ($results as $li)
                        <ul style="" >
                            <li>{{ $li->id }}</li>
                            <li>{{ $li->name }}</li>
                            <li>{{ $li->mobile }}</li>
                            <li>{{ $li->created_at }}</li>
                            <li>{{ $li->updated_at }}</li>
                            <button value="{{$li->id}}" class="delete text-danger" >Delete</button>
                            <button value="{{$li->id}}" class="update text-dark" >Update</button>
                        </ul>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="/js/custom.js"></script>

</body>

</html>
