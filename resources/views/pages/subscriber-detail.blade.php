@extends('components.main-layout')
@section('content')
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
        <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="p-6">
                <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                    {{$subscriber->lastname}} {{$subscriber->firstname}} {{$subscriber->middlename}}
                </h5>
                <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                    {{$subscriber->address}}
                </p>
                @if ($subscriber->gender == "F")
                    <h3 class="text-pink-500 mb-2">Female</h3>
                @else
                    <h3 class="text-purple-500 mb-2">Male</h3>
                @endif
                <div id="providerContainer">
                    @if ($providers != null)
                        @unless (count($providers) == 0)
                            @foreach ($providers as $item)
                                <div id={{$item->id}} class="flex justify-between items-center">
                                    <h4 class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">              {{$item->provider}} - {{$item->phone}}
                                    </h4>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <a onclick="deleteProvider({{$item->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endunless
                    @endif
                </div>
            </div>
            
            <div class="p-6 pt-0">
                <button id="btnToggleProvider"
                class="select-none rounded-lg bg-pink-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button"
                data-ripple-light="true"
                >
                    Provider
                </button>
                <a href="/"
                    class="select-none rounded-lg bg-pink-100 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-pink-500 shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button"
                    data-ripple-light="true"
                >
                    Back
                </a>
                
            </div>
        </div>
    </div>
    <div>
    <div id="providerWrapper" class="hidden relative w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
        <form id="addProviderForm" action="{{ URL::to('save-provider') }}">
            <div class="p-6">
                <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                    New Provider
                </h5>
                <input type="hidden" name="id" value={{$subscriber->id}}>
                <input required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="provider" name="provider" type="text" placeholder="provider">
                <input required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded mt-4 w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="phone" name="phone" type="text" placeholder="phone">
            </div>
            <div class="p-6 pt-0">
                <button
                    class="select-none rounded-lg bg-pink-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="submit"
                    data-ripple-light="true"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection