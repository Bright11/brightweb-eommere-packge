<?php

namespace Brightweb\Ecommerce\Http\Livewire\Backend;


use Livewire\Component;

use Brightweb\Ecommerce\Models\CouponBalanc;
use Brightweb\Ecommerce\Models\Coupon;

use Carbon\Carbon;

class Admincouponcode extends Component
{
 

    public $code='';
    public $expires_at='';
    public $discount_percentage='';
    public $max_users='';
    public $onetimeusage="";
    public $coupons;


   

    public function mount()
    {
        $this->coupons=Coupon::all();
    }
    public function savecoupon()
    {
     
        $validated = $this->validate([
            'code' => 'required|string|unique:coupons,code',
            'discount_percentage' => 'required|numeric|min:0',
            'max_users'=>'numeric|min:0',
            "onetimeusage"=>"required",
            'expires_at' => 'required|date_format:d-m-Y|after:today',

        ]);

        $couponcode=new Coupon;
        $date=Carbon::createFromFormat('d-m-Y', $this->expires_at)->format('Y-m-d');
        $couponcode->code=str_replace(' ', '', $this->code);
        $couponcode->discount_percentage=$this->discount_percentage;
       if($this->max_users){
        $couponcode->max_users=$this->max_users;
       }else{
        $couponcode->max_users=0;
       }
       if($this->onetimeusage=="yes"){
        $couponcode->one_time_use=true;
       }else{
        $couponcode->one_time_use=false;
       }
        $couponcode->expires_at=$date;
        $couponcode->save();
        $this->clearinput();
        session()->flash('message', 'Coupon code added');
        $this->mount();
       
    }

    public function clearinput()
    {
        $this->reset([
            'code',
            'discount_percentage',
            'expires_at',
            "max_users"
           
        ]);
    }

    public function activate($id){
        $coupon=Coupon::find($id);
        if( $coupon->status=="deactivate"){
            $coupon->status="active";
        }else{
            $coupon->status="deactivate";
        }
      
        $coupon->save();
        session()->flash('message', "Coupon  $coupon->status successfully");
        $this->mount();
    }
    public function render()
    {
        return view('brightweb::livewire.backend.admincouponcode',['coupons'=>$this->coupons]);
    }
}
