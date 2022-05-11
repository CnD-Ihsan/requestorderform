<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="card text-center" style="width:35%;margin:auto">
            <h5 class="card-header p-4">Register New User</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" style="padding:10px;">
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
                        <br>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
                        <br>
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />
                        <br>
                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />
                        <br>
                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required />
                    </div>

                    <!-- Department -->
                    <div class="mt-4">
                        <x-label for="dept" :value="__('Department/Contractor')" />
                        <br>
                        <select name="dept" id="dept" class="block mt-1 w-full">
                            <option selected value=""></option>
                            <option value="Finance">Dept. of Finance</option>
                            <option value="BDD">Dept. of BDD</option>
                            <option value="Engineering">Dept. of Engineering</option>
                            <option value="Maribumi">Maribumi</option>
                            <option value="Fiberhome">Fiberhome</option>
                            <option value="Apex">Apex</option>
                            <option value="Redaway">Redaway</option>
                            {{-- @for($i=0; $i < count($contractors); $i++ )
                                <option value="{{ $contractors[$i]; }}">{{ $contractors[$i]; }}</option>
                            @endfor --}}
                        </select>
                    </div>

                    <!-- ISP -->
                    <div class="mt-4">
                        <x-label for="isp" :value="__('ISP')" />
                        <br>
                        <select name="isp" id="isp" class="block mt-1 w-full">
                            <option selected value=""></option>
                            <option value="Celcom">Celcom</option>
                            <option value="Maxis">Maxis</option>
                            <option value="Digi">Digi</option>
                            <option value="YTL">YTL</option>
                            <option value="Others">Others</option>
                        </select>                    
                    </div>

                    <!-- User Type -->
                    <div class="mt-4">
                        <x-label for="user_type" :value="__('User Type')" />
                        <br>
                        <select name="user_type" id="user_type" class="block mt-1 w-full">
                            <option value="User">User</option>
                            <option value="HOD">HOD</option>
                            <option value="Contractor">Contractor</option>
                        </select>                    
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button class="ml-4">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
