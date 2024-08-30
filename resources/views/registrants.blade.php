<html>

<head>
    <title>Registrants</title>
</head>

<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="items-aligen-center">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{$title}}
                    </h2>
                </div>
                <x-bladewind::table stripped="true" name="tblregistrant"
                    data="{{ DB::table('vwregistrant')->select()->limit(10)->get() }}" />
            </div>
        </div>
    </div>
</body>

</html>
