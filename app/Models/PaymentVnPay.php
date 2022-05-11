<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVnPay extends Model
{
    use HasFactory;
    protected $table = 'payment_vnpay';
    protected $fillable = ['vnp_Amount','vnp_BankTranNo','vnp_BankCode','vnp_CardType','vnp_OrderInfo','vnp_PayDate','vnp_TmnCode','vnp_TransactionNo','vnp_TxnRef'];
}

