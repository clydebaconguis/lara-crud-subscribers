@extends('../components/main-layout')
@section('content')
<div class="flex justify-center items-center shadow-md w-full h-full rounded p-5 bg-black">
    <div class="p-6 border rounded bg-white">
        
        @if(session()->has('message')) <p class="bg-green-100 rounded text-center p-4 text-gray-900 m-3"><i class="fa fa-check-circle text-green-500"></i> {{session('message')}}</p> @endif

        <form id="updateForm" method="POST" class="p-3" action="/update/{{$id}}">
            @csrf
            <h1 class="text-center font-bold uppercase text-purple-700 mb-5 text-lg">Edit Subscriber</h1>
            <div>
                <div class="md:flex justify-center items-center">
                    <div class="w-1/3">
                    <label class="block text-gray-500 font-bold mb-1 mr-2" for="firstname">
                        Firstname
                    </label>
                    </div>
                    <div>
                    <input required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="firstname" name="firstname" value={{$firstname}} type="text">
                    </div>
                </div>
                <div class="mb-6">
                    @error('firstname')
                    <p class="bg-red-300 text-center rounded p-1 mt-2 text-white">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div>
                <div class="md:flex justify-center items-center">
                    <div class="w-1/3">
                    <label class="block text-gray-500 font-bold mb-1 mr-2" for="middlename">
                        Middlename
                    </label>
                    </div>
                    <div>
                    <input required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" value={{$middlename}} id="middlename" name="middlename" type="text">
                    </div>
                </div>
                <div class="mb-6">
                    @error('middlename')
                    <p class="bg-red-300 text-center rounded p-1 mt-2 text-white">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div>
                <div class="md:flex justify-center items-center">
                <div class="w-1/3">
                    <label class="block text-gray-500 font-bold mb-1 mr-2" for="lastname">
                    Lastname
                    </label>
                </div>
                <div>
                    <input required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" value={{$lastname}} id="lastname" name="lastname" type="text" >
                </div>
                </div>
                <div class="mb-6">
                    @error('lastname')
                    <p class="bg-red-300 text-center rounded p-1 mt-2 text-white">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div>
                <div class="md:flex justify-center items-center">
                    <div class="w-1/3">
                    <label class="block text-gray-500 font-bold mb-1 mr-2" for="address">
                        Address
                    </label>
                    </div>
                    <div>
                    <input required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" value={{$address}} id="address" name="address" type="text">
                    </div>
                </div>
                <div class="mb-6">
                    @error('address')
                    <p class="bg-red-300 text-center rounded p-1 mt-2 text-white">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div>
                <div class="md:flex justify-evenly items-center">
                    @if ($gender == "M")
                        <label class="block text-gray-500 font-bold mb-1 mr-2" for="m">
                            <input id="m" checked type="radio" name="gender" value="M"> Male 
                        </label>
                        <label class="block text-gray-500 font-bold mb-1 mr-2" for="f">
                            <input id="f" type="radio" name="gender" value="F"> Female 
                        </label>
                    @else
                        <label class="block text-gray-500 font-bold mb-1 mr-2" for="m">
                            <input id="m" type="radio" name="gender" value="M"> Male 
                        </label>
                        <label class="block text-gray-500 font-bold mb-1 mr-2" for="f">
                            <input id="f" checked type="radio" name="gender" value="F"> Female 
                        </label>
                    @endif
                </div>
                <div class="mb-6">
                    @error('gender')
                    <p class="bg-red-300 text-center rounded p-1 mt-2 text-white">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-4 flex justify-center items-center space-x-5">
                <button class="text-center w-1/3 shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Update
                </button>
                <a href="/" class="text-center w-1/3 shadow hover:text-purple-200 focus:shadow-outline focus:outline-none text-purple-500 font-bold py-2 px-4 rounded" type="button">
                Back
                </a>
            </div>
        </form>
    </div>
</div>
@endsection