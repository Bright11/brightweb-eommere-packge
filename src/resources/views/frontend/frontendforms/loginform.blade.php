<form wire:submit.prevent="loginuser" class="loginform">
    @if (session()->has('message'))
    <div style="color: red">{{ session('message') }}</div>
@endif
    <div class="login_input_div">
        <label >Email</label>
        <input type="email" wire:model="email" placeholder="email@domain.com">
        {{-- @if($errors->has('email'))
        <div class="error">{{ $errors->first('email') }}</div>
    @endif --}}
    @if ($errors->has('email'))
    @error('email') <span class="error" style="color: red">{{ $message }}</span> @enderror
@endif

        
    </div>
    <div class="login_input_div">
        <label>Password</label>
        <input type="password" id="password" wire:model="password" placeholder="Your password">
        @if ($errors->has('password'))
        @error('password') <span class="error" style="color: red">{{ $message }}</span> @enderror
        @endif
       
    </div>
   
    <div class="login_btn">
        <button>Login</button>
    </div>
    <div class="reset_password">
        <a href="">Forget password</a>
        <button onclick="showPassword()" type="button">Show password</button>
    </div>
</form>
<div class="account_suggestion">
    <a href="#" wire:click.prevent="toggleForm">Don't have an account? Rgister here</a>
</div>