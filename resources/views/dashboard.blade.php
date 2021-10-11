<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->
                @if(\Spatie\Multitenancy\Models\Tenant::checkCurrent())
                <p class="bg-white">{{app('currentTenant')->name}}</p>
                @else
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="mt-8 text-4xl">
                        <table class="table-auto">
                            <thead>
                                <tr>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Author</th>
                                <th class="px-4 py-2">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="border px-4 py-2">Intro to CSS</td>
                                <td class="border px-4 py-2">Adam</td>
                                <td class="border px-4 py-2">858</td>
                                </tr>
                                <tr class="bg-gray-100">
                                <td class="border px-4 py-2">A Long and Winding Tour of the History of UI Frameworks and Tools and the Impact on Design</td>
                                <td class="border px-4 py-2">Adam</td>
                                <td class="border px-4 py-2">112</td>
                                </tr>
                                <tr>
                                <td class="border px-4 py-2">Intro to JavaScript</td>
                                <td class="border px-4 py-2">Chris</td>
                                <td class="border px-4 py-2">1,280</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>



                @endif
            </div>
        </div>
    </div>
</x-app-layout>
