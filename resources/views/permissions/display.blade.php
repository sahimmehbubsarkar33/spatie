<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Persmissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <table class="table table-bordered">

                   <tr>
                    <th>Sl.no</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                   </tr>
                   @foreach($permissions as $permission)
                   <tr>
                    <td>{{$permission->id}}</td>
                    <td>{{$permission->name}}</td>
                    <td><a href="{{route('permissions.edit',[$permission->id])}}" class="bnt btn-sm btn-primary">Edit</a></td>
                    <td><a href="{{route('permissions.delete',[$permission->id])}}" class="btn btn-sm btn-danger">Delete</a></td>
                   </tr>
                   @endforeach
                   </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
