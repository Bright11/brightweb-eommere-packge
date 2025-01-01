<form wire:submit.prevent="register" class="loginform">
    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
  
    <div class="login_input_div">
        <label for="name">User Name</label>
        <input type="text" id="name" wire:model="name" placeholder="Your name">
        @if ($errors->has('name'))
        @error('name') <span class="error" style="color: red">{{ $message }}</span> @enderror
        @endif
       
    </div>
    <div class="login_input_div">
        <label for="email">Email</label>
        <input type="email" id="email" wire:model="email" placeholder="email@domain.com">
        @if ($errors->has('email'))
        @error('email') <span class="error" style="color: red">{{ $message }}</span> @enderror
        @endif
    </div>
    <div class="login_input_div">
        <label for="password">Password</label>
        <input type="password" id="password" wire:model="password" placeholder="Your password">
        @if ($errors->has('password'))
        @error('password') <span class="error" style="color: red">{{ $message }}</span> @enderror
        @endif
       
    </div>
    <div class="login_input_div">
        <label for="c_password">Confirm password</label>
        <input type="password" id="c_password" wire:model="c_password" placeholder="confirm password">
        @if ($errors->has('c_password'))
        @error('c_password') <span style="color: red" class="error">{{ $message }}</span> @enderror
        @endif
     
    </div>
    <div class="login_btn">
        <button>Register</button>
    </div>
    <div class="reset_password">
        <a href="">Forget password</a>
        <button onclick="showPassword()" type="button">Show password</button>
    </div>
</form>
<div class="account_suggestion">
    <a href="#" wire:click.prevent="toggleForm">Already have an account? Login here</a>
</div>

