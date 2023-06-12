@extends('../components/main-layout')
@section('content')
    <div class="z-40 overlay fixed bg-gray-500 top-0 right-0 bottom-0 opacity-40 left-0 hidden">
    </div>

    <!--Container-->
    <div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">
        <!--Title-->
        <h1 class="title m-2 flex items-center font-sans font-bold break-normal text-indigo-500 text-xl md:text-2xl">
            CRUD SUBSCRIBERS
        </h1>
        @if(session()->has('message')) <p class="bg-green-100 rounded text-center p-4 text-gray-900 m-3">{{session('message')}}</p> @endif

        <div class="flex justify-end">
            <a onclick="showForm()" type="button" class="bg-blue-500 mb-2 flex text-center justify-center items-center hover:bg-blue-700 text-white font-bold py-2 px-4 text-sm rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                New
            </a>
        </div>

        <!--Card-->
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr class="text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left" data-priority="1">Firstname</th>
                        <th class="py-3 px-6 text-center" data-priority="2">Middlename</th>
                        <th class="py-3 px-6 text-center" data-priority="3">lastname</th>
                        <th class="py-3 px-6 text-center" data-priority="4">Gender</th>
                        <th class="py-3 px-6 text-center" data-priority="5">Address</th>
                        <th class="py-3 px-6 text-right" data-priority="6">Actions</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="text-gray-600 text-sm font-light">
                    @unless (count($subscribers) == 0)
                        @foreach ($subscribers as $item)
                            <tr id={{$item->id}} class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <img class="w-6 h-6 rounded-full" src="https://randomuser.me/api/portraits/men/{{$item->id}}.jpg"/>
                                        </div>
                                        <span>{{$item->lastname}}</span>
                                    </div>
                                </td>

                                <td class="py-3 px-6 text-center">
                                    <span>{{$item->firstname}}</span>
                                </td>

                                <td class="py-3 px-6 text-center">
                                    <span>{{$item->middlename}}</span>
                                </td>

                                <td class="py-3 px-6 text-center">
                                    @if ($item->gender == "F")
                                        <span class="bg-pink-200 text-pink-600 py-1 px-3 rounded-full text-xs">{{$item->gender}}</span>
                                    @else
                                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{$item->gender}}</span>
                                    @endif
                                </td>

                                <td class="py-3 px-6 text-center">
                                    <span>{{$item->address}}</span>
                                </td>

                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="/show/{{$item->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="/edit/{{$item->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div onclick="toggleModalDelete({{$item->id}})" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endunless
                </tbody>
            </table>


        </div>
        <!--/Card-->
    </div>
    <!--/container-->

    <!--Modal form-->
    <div id="modal" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform rounded p-5 z-50 bg-white hidden">
        <form id="addForm" method="POST" class="p-3" action="{{ URL::to('save')}}">
            @csrf
            <div class="flex justify-end"><i onclick="hideForm()" class="fa fa-times mb-5" aria-hidden="true"></i></div>
            <p id="check-notif" class="bg-green-100 rounded text-center p-4 text-gray-900 m-3 hidden"><i class="fa fa-check-circle text-green-500"></i> Added Successfully</p>
            <h1 class="text-center font-bold uppercase text-purple-700 mb-5 text-lg">Add New Subscriber</h1>
            <div>
                <div class="md:flex justify-center items-center">
                    <div class="w-1/3">
                    <label class="block text-gray-500 font-bold mb-1 mr-2" for="firstname">
                        Firstname
                    </label>
                    </div>
                    <div>
                    <input required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="firstname" name="firstname" type="text">
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
                    <input required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="middlename" name="middlename" type="text">
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
                    <input required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="lastname" name="lastname" type="text" >
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
                    <input required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="address" name="address" type="text">
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
                    <label class="block text-gray-500 font-bold mb-1 mr-2" for="m">
                        <input id="m" type="radio" name="gender" value="M"> Male 
                    </label>
                    <label class="block text-gray-500 font-bold mb-1 mr-2" for="f">
                        <input id="f" type="radio" name="gender" value="F"> Female 
                    </label>
                </div>
                <div class="mb-6">
                    @error('gender')
                    <p class="bg-red-300 text-center rounded p-1 mt-2 text-white">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-4 flex justify-center">
                <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Save
                </button>
            </div>
        </form>
    </div>
    <!--Modal form-->

    <!--Modal Delete-->
    <div id="modal-delete" class="shadow-lg fixed top-0 left-1/2 transform transition-all duration-1000 -translate-x-1/2 ease-in-out p-5 border-red-950 rounded-md m-5 hidden bg-white">
        <div>
            <form id="delForm" action="{{ URL::to('destroy')}}">
                @csrf
                <i class="fa fa-exclamation-triangle flex justify-center text-lg text-red-800" aria-hidden="true"></i>
                <h1 id="del-para" class="text-sm">Are you sure you want to delete this subscriber?</h1>
                <input type="hidden" name="subscriber_id" id="subscriber_id">
                <div class="flex justify-center items-center space-x-3 mt-3">
                    <button type="submit" class="rounded font-bold bg-red-950 text-white text-sm py-1 px-2 hover:bg-red-600">Yes, I'm sure</button>
                    <button type="button" class="rounded font-bold text-sm text-red-900 hover:text-red-600" onclick="toggleModalDelete(0)">No, Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection       