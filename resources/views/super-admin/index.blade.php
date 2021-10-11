<x-app-layout>

        <div class="bg-gradient-to-br from-purple-500 to-indigo-800 flex flex-wrap justify-center min-h-screen">
            <table class="table table-auto">
                <thead>
                    <tr class="text-left font-bold">
                        <td class="border-b-2 dark:border-dark-5 whitespace-nowrap">ID</td>
                        <td class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</td>
                        <td class="border-b-2 dark:border-dark-5 whitespace-nowrap">Domain</td>
                        <td class="border-b-2 dark:border-dark-5 whitespace-nowrap">Database</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr class="text-left font-bold">
                        <td class="border">{{$d->id}}</td>
                        <td class="border">{{$d->name}}</td>
                        <td class="border">{{$d->domain}}</td>
                        <td class="border">{{$d->database}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</x-app-layout>

