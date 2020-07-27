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
            @if( !isset($results))
                <form id='form1' action="daterange">
                    <h2>Please fill in any fields and then click get results</h2>
                
                    Location <select name="location" > <option value=''>-</option>
                    @isset($location_values)
                                         @foreach($location_values as $value)
                                             <option value={{ $value->id }}>{{ $value->name }}</option>
                                         @endforeach
                
                    @endisset
                    </select><br>
    
    
    
                    Status <select name="status" > <option value=''>-</option>
                    @isset($status_values)
                                         @foreach($status_values as $value)
                                             <option value={{ $value->status }}>{{ $value->status }}</option>
                                         @endforeach
                    
                    @endisset
                    </select><br>
                    
                    Start Date <select name="start_date" > <option value=''>-</option>
                    @isset($date_values)
                                         @foreach($date_values as $value)
                                             <option value={{ $value->date }}>{{ $value->date }}</option>
                                         @endforeach
                    
                    @endisset
                    </select><br>
        
                    End Date <select name="end_date" > <option value=''>-</option>
                    @isset($date_values)
                                         @foreach($date_values as $value)
                                             <option value={{ $value->date }}>{{ $value->date }}</option>
                                         @endforeach
                
                    @endisset
                    </select><br>
    
                    <br>
                    <input type="submit" name="submit" value="Get Results">
                </form>
            @endisset

            {{-- If we have submitted the form and have some resuls --}}

            @if( !empty($results))

                <h1>KitchenCut Selection Results </h1>
                <table align=center border="1">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total Value </th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($results as $result)
                          <tr>
                              <td> {{$result->location_name}} </td>
                              <td> {{$result->date}} </td>
                              <td> {{$result->status}} </td>
                              <td> {{$result->total}} </td>
                          </tr>
                         @endforeach
                   </tbody>
                </table>
            @endif

            <div class="links">
                <br>
                <br>
                @if( isset($results))
                    <a href="/kitchencut/daterange">Back to selection criteria </a>
                @endif
                <a href="/kitchencut/location">KitchenCut 'by-location' selection page</a>
             </div>

            </div>
        </div>
    </body>
</html>
