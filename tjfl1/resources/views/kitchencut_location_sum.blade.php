<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
            <div class="content">
           
            @isset($locations)
                <h2>Please select a location to see the total value by status </h2>
                <tbody>
                @foreach($locations as $location)
                    <a href="/kitchencut/locationsum/{{$location->id}}">{{ $location->name }}</a> <br>
                @endforeach
                </tbody>

            @endisset


            @isset($location_id)
                <h1>KitchenCut Statisics for Location {{ $location_id }}</h1>

                @if(!empty($error) )
                    <h2>{{ $error }}
                @elseif( empty($results) && empty($error) )
                    <h2>Sorry, there are no results for this location</h2>
                @else
                    <table align=center border="1">
                        <thead>
                            <tr>
                                <th> Status</th>
                                <th> Total Value </th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($results as $result)
                              <tr>
                                  <td> {{$result->status}} </td>
                                  <td> {{$result->total}} </td>
                              </tr>
                             @endforeach
                       </tbody>
                    </table>
                @endif
            @endisset

                <br>
                <br>
                <div class="links">
                    <a href="/kitchencut/location">Back to location selection</a>
                    <a href="/kitchencut/daterange">KitchenCUT multi criteria selection page</a>
                </div>

            </div>
        </div>
    </body>
</html>
