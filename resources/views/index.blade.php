<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <title>Historique</title>

<style type="text/css">
    nav {
        display: flex;
        align-items: center;
        background-color: #0c9172;
        padding: 5px;
        border-radius: 5px;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    nav ul li a {
        color: #ffffff;
        text-decoration: none;
        margin-right: 20px;
    }

    nav div {
        color: #ffffff;
        margin-right: 50px;
    }

    .search-bar {
        margin-left: auto;
        display: flex;
        align-items: center;
    }

    .search-bar input[type="text"] {
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        margin-right: 8px;
        width: 300px;
    }

    .search-bar button {
        padding: 8px 12px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    aside {
        width: 200px;

    }


    /*

        Sous-menu


    */

        aside#sous-menu {
            width: 200px;
            background-color: #f1f1f1;
            position: relative;
            left: 0;
            top: 0;
        }

        aside#sous-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 17px;
        }

        aside#sous-menu li {
            margin-top: 13px;
            border-bottom: 1px solid #ddd;
        }

        aside#sous-menu li a {
            text-decoration: none;
            color: black;
        }

        aside#sous-menu li:hover {
            background-color: #e0e0e0;
        }

        aside ol.option{
            text-decoration: none;
            display: flex;
            flex-direction: column;
            list-style: none;
            margin-left: -20px;
        }

        aside li.option{
            margin-top: 01px;
        }

        #container{
            display: flex;
        }

        #content{
            border: 3px solid black;
        }
        #content#zone{
            margin: 20px 20px 20px 20px;
            padding:10px;
        }

</style>

</head>
<body>
    @include('menuTop')
    @include('menuAside')
    <div id="content zone">
        @yield('content')
    </div>
    </div>
    @include('footer')
</body>
</html>
