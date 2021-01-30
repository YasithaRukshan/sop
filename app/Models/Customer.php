<?php

namespace App\Models;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'chat_resolved',
        'chat_activated',
        'reminder',
        'parent_id',
        'email_verified_at',
        'simulate_session',
        'image_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Sent verification email
     *
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    /**
     * Get user image
     *
     */
    public function profileimage()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    /**
     * wallet
     *
     * @return void
     */
    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet', 'customer_id');
    }

    /**
     * Available SOAX
     *
     * @return void
     */
    public function soax($is_pure = false)
    {
        $wallet = Wallet::where('customer_id', $this->id)->first();
        if (!$is_pure) {
            return (($wallet->amount > 0) ? number_format($wallet->amount, 2)  : 'empty');
        } else {
            return $wallet ? $wallet->amount : 0;
        }
    }

    /**
     * referrals [Here WIll Catch child Referrals]
     *
     * @return void
     */
    public function referrals()
    {
        return $this->hasMany(Customer::class, 'parent_id');
    }

    /**
     * referrer [Here WIll Catch PArent Referrer]
     *
     * @return void
     */
    public function referrer()
    {
        return $this->belongsTo(Customer::class, 'parent_id');
    }

    /**
     * get by username
     *
     * @return Customer
     */
    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function referralsSorted($limit = null, $offset)
    {
        $resp = $this->where('parent_id', $this->id)->get();
        if ($limit) {
            $resp = $resp->slice($offset)->take($limit);
        }
        $return_data = [];
        foreach ($resp->toArray() as $new) {
            $return_data[] = $new;
        }
        return $return_data;
    }
    /**
     * referrals
     *
     * @return void
     */
    public function referralscount()
    {
        $data = $this->hasMany('App\Models\Customer', 'parent_id');
        $count = count($data);
        return  $count;
    }

    /**
     * Token Status Count
     *
     * @return void
     */
    public function tokenStatusCount()
    {
        $data = WalletTransaction::where('wallet_id', $this->wallet->id)
            ->where('status', 1)
            ->get();
        $count = count($data);
        return  $count;
    }

    /**
     * production Count
     *
     * @return void
     */
    public function productionCount()
    {
        $data = Contract::where('customer_id', $this->id)
            ->get();
        $count = count($data);
        return  $count;
    }
    /**
     * contracts
     *
     * @return void
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'customer_id');
    }

    /**
     * Token Status Count
     *
     * @return void
     */
    public function withdrawalStatusCount()
    {
        $data = Withdrawal::where('wallet_id', $this->wallet->id)
            ->where('status', 1)
            ->get();
        $count = count($data);
        return  $count;
    }
}
