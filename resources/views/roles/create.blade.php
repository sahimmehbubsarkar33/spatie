<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="container">

              
                    <form action="{{route('roles.create')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for=""><strong>Roles :</strong></label>
                            <input type="text" name="name" id="" class="form-control">
                    @if($permissions->isNotEmpty())
                    @foreach($permissions as $permission)
                    <div>
                        <input type="checkbox"  name="permission[]" id="permission->{{ $permission->id }}" value="{{ $permission->name}}">
                        <label for="">{{ $permission->name }}</label>
                    </div>
                    @endforeach
                    @endif
                            <button class='btn btn-sm btn-primary'>Submit</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
