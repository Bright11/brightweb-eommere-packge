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
    public $usage_count='';
    public $coupons;


   

    public function mount()
    {
        $this->coupons=CouponBalanc::all();
    }
    public function savecoupon()
    {
     
        $validated = $this->validate([
            'code' => 'required|string|unique:coupons,code',
            'discount_percentage' => 'required|numeric|min:0',
            'usage_count'=>'numeric|min:0',
            'expires_at' => 'required|date_format:d-m-Y|after:today',
        ]);

        $couponcode=new Coupon;
        $date=Carbon::createFromFormat('d-m-Y', $this->expires_at)->format('Y-m-d');
        $couponcode->code=str_replace(' ', '', $this->code);
        $couponcode->discount_percentage=$this->discount_percentage;
       if($this->usage_count){
        $couponcode->usage_count=$this->usage_count;
       }else{
        $couponcode->usage_count=0;
       }
        $couponcode->expires_at=$date;
        $couponcode->save();
        $this->clearinput();
        session()->flash('message', 'Coupon code added');
       
    }

    public function clearinput()
    {
        $this->reset([
            'code',
            'discount_percentage',
            'usage_count',
            'expires_at',
           
        ]);
    }
    public function render()
    {
        return view('brightweb::livewire.backend.admincouponcode',['coupons'=>$this->coupons]);
    }
}
