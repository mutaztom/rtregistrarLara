<html>
</style>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('css/reportstyle.css') }}" />
    <title>Registrants Report</title>
</head>

<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="items-aligen-center">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        <span
                            style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">{{ $title }}</span><br />
                    </h2>
                </div>
                <table class="table table-responsive" id="tblregistrant">
                    <thead colspan="2">
                        <th>Registrant</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Eng Class</th>
                        <th>Eng Cat</th>
                    </thead>
                    <tbody>
                        @foreach ($registrants as $reg)
                            <tr colspan="2">
                                <td>{{ $reg->regname }}</td>
                                <td>{{ $reg->email }}</td>
                                <td>{{ $reg->phone }}</td>
                                <td>{{ $reg->hieducid }}</td>
                                <td>{{ $reg->address }}</td>
                            </tr>
                            <div class="page-break"></div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
