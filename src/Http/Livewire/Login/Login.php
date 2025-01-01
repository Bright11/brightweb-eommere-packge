<?php
namespace Brightweb\Ecommerce\Http\Livewire\Login;

use Brightweb\Ecommerce\Models\Referral_usage;
use Livewire\Component;
use Illuminate\Http\Request;
// use App\Models\User;
use Brightweb\Ecommerce\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class Login extends Component
{
    public $switchform = true;
    public $userIp;

    public $name;
    public $email;
    public $password;
    public $c_password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'min:6|required_with:c_password|same:c_password'
    ];

    public function mount(Request $request)
    {
        $this->userIp = $request->ip();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
       
    }

    public function register()
    {
        $this->validate();
       
        
        $ip = request()->ip();
        // check if ip address already exists
        $check_ip=User::where("ip_address", $ip)->first();
        if($check_ip){
            return session()->flash('message', 'User already registered.');
        }
        // dd($ip);
       // $referalcode='txn_' . uniqid() . '_' . time() . '_' . Str::random(10);
       $referalcode = $this->generateUniqueReferralCode();
        // dd($referalcode);
       $user= User::create([
            'name' => $this->name,
            'email' => strtolower($this->email),
            'password' => Hash::make($this->password),
            'referral_code'=>$referalcode,
             'ip_address' => $this->userIp,
        ]);
       
        $check_referral=Referral_usage::where("userip",$ip)->first();
        if($check_referral){
          $check_referral->status="Completed";
          $check_referral->referee_id=$user->id;
          $check_referral->save();
        }
        $this->clearform();
        $this->switchform = !$this->switchform;
        session()->flash('message', 'User successfully registered.');
      
    }
    public function clearform(){
        $this->reset([
            'name','email','password','c_password'
        ]);
       
    }
    public function toggleForm()
    {
        $this->switchform = !$this->switchform;
    }
   
    public function loginuser(Request $request)
    {
        $validate = $this->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);
        if(Auth::attempt(['email'=>strtolower($this->email), "password"=>$this->password,"status"=>"active"])){
            $request->session()->regenerate();
            $user=Auth::user();
            return redirect("/");
        }else{
            session()->flash('message', 'User not found or suspended, Try again.');
        }

    }

    private function generateUniqueReferralCode()
{
    // Try generating the referral code until it is unique
    do {
        // Generate referral code with random strings and timestamp
        $referalcode = 'txn_' . Str::random(8) . '_' . time() . '_' . Str::random(5);
    } while (User::where('referral_code', $referalcode)->exists());  // Check if the code exists
    
    return $referalcode;
}

        public function render()
    {
        return view('brightweb::livewire.login.login');
    }
}
