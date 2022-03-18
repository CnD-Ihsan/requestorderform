<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <h1>Add new user</h1>
        </x-slot>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            
            <!-- Department -->
            <div>
                <x-label for="dept" :value="__('Dept')" />

                <x-input id="dept" class="block mt-1 w-full" type="text" name="dept" :value="old('dept')" required autofocus />
            </div>
            
            <!-- ISP -->
            <div class="mt-1"">
                <x-label for="isp" :value="__('ISP')" />
                <select name='isp' id='isp' :value="old('isp')" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">

                    <?php $isps = array("Digi","Maxis","Celcom","U Mobile","YTL");?>
                    @foreach($isps as $isp => $value)
                        
                        <!--This line set the first option value to be selected by default-->
                        <option value="{{ $value }}" @if($isp==0) selected @endif> 
                        <?php echo $value?>
                        </option>   

                    @endforeach 
                </select>
            </div>
            
            <!-- User Type -->
            <div class="mt-1"">
                <x-label for="user_type" :value="__('User Type')" />
                <select name='user_type' id='user_type' :value="old('user_type')" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
                    
                    <?php $user_types = array("User","HOD","Contractor");?>
                    @foreach($user_types as $user_type => $value)
                        
                        <!--This line set the first option value to be selected by default-->
                        <option value="{{ $value }}" @if($user_type==0) selected @endif> 
                        <?php echo $value?>
                        </option>   

                    @endforeach 
                </select>
            </div>

            <!-- Password -->
            <div class="mt-1">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-1">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
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
    </x-auth-card>
</x-guest-layout>
