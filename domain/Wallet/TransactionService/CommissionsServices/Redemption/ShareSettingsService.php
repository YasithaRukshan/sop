<?php

namespace domain\Wallet\TransactionService\CommissionsServices\Redemption;

use App\Models\ShareSettings;
use Illuminate\Support\Facades\Auth;

class ShareSettingsService
{
    protected $share_settings;
    public function __construct()
    {
        $this->share_settings = new ShareSettings();
    }
    /**
     * get
     *
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->share_settings->find($id);
    }
    /**
     * get Account
     *
     * @param  mixed $type
     * @param  mixed $wallet_id
     * @return ShareSettings
     */
    public function getAccount($type, $wallet_id)
    {
        return $this->share_settings->getAccount($type, $wallet_id);
    }
    /**
     * make
     *
     * @param  mixed $date
     * @return mixed
     */
    public function make($data)
    {
        if ($wallet = Auth::user()->wallet) {
            $data['wallet_id'] = $wallet->id;
            if ($settings = $wallet->shareSettings) {
                return $this->update($settings, $data);
            } else {
                return $this->create($data);
            }
        }
    }
    /**
     * create
     *
     * @param  mixed $date
     * @return mixed
     */
    public function create($date)
    {
        return $this->share_settings->create($date);
    }
    /**
     * update
     *
     * @param  ShareSettings $share_settings
     * @param  mixed $data
     * @return void
     */
    public function update(ShareSettings $share_settings, array $data)
    {
        $share_settings->update($this->edit($share_settings, $data));
    }
    /**
     * edit
     *
     * @param  ShareSettings $share_settings
     * @param  mixed $data
     * @return mixed
     */
    public function edit(ShareSettings $share_settings, array $data)
    {
        return array_merge($share_settings->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $share_setting = $this->get($id);
        $share_setting->delete();
    }
}
