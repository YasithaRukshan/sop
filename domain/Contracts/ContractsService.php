<?php

namespace domain\Contracts;

use App\Events\NewStakeEvent;
use App\Models\Contract;
use App\Models\ContractProduction;
use App\Traits\WalletHelper;
use DateTime;
use Carbon\Carbon;
use domain\Facades\SOAXStakeFacade;
use domain\Facades\ProductionFacade;
use domain\Facades\PortfolioFacade;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: Speralabs
 * Date: 10/07/2020
 * Time: 02:10 PM
 */
class ContractsService
{
    use WalletHelper;

    protected $Contract;
    protected $contractProduction;
    public function __construct()
    {
        $this->contract = new Contract();
        $this->contractProduction = new ContractProduction();
    }
    /**
     * Get All Contracts
     */
    public function all()
    {
        return $this->contract->all();
    }
    /**
     * get
     *
     * @param  mixed $id
     * @return void
     */
    public function get($id)
    {
        return $this->contract->find($id);
    }
    /**
     * getByPortFolio
     *
     * @param  mixed $portfolio_id
     * @return void
     */
    public function getByPortFolio($portfolio_id)
    {
        return $this->contract->getByPortFolio($portfolio_id);
    }
    /**
     * Get data Contracts By Auth
     */
    public function getByAuth()
    {
        return $this->contract->where('customer_id', Auth::user()->id)->get();
    }
    /**
     * get By En Id
     *
     * @param  mixed $enId
     * @return void
     */
    public function getByEnId($enId)
    {
        foreach ($this->getByAuth() as  $contract) {
            if ($enId == md5($contract->id)) {
                return $contract;
            }
        }
        return null;
    }
    /**
     * Get data Contracts for view
     */
    public function view($id)
    {
        $data['sales_value'] = 0;
        $data['available_value'] = 0;
        $data['portfolio_value'] = 0;
        $authData = $this->getByAuth();
        foreach ($authData as  $value) {
            if ($id == md5($value['id'])) {
                $portfolio = PortfolioFacade::get($value['portfolio_id']);
                $data['portfolio_value'] = $portfolio['price'];
                $contracts = $this->contract->where('portfolio_id', $value['portfolio_id'])->get();
                foreach ($contracts as $contract) {
                    $data['sales_value'] = $data['sales_value'] + $contract['amount'];
                }
                $data['available_value'] = $portfolio['price'] - $data['sales_value'];
                $data['sales_value'] = $data['sales_value'] - $value['amount'];
                $data['value'] = $value;
                return $data;
            }
        }
        return null;
    }
    /**
     * Auto Stake
     *
     * @param  mixed $wallet
     * @return void
     */
    public function autoStake()
    {
        $wallets = WalletFacade::allStackable();
        foreach ($wallets as $key => $wallet) {
            $amount = $wallet->amount;
            $customer = $wallet->user;
            if ($amount >= config('smartcontract.min_contract_soax')) {

                $resp = PortfolioFacade::getAvailableContracts($amount);

                if ($resp) {
                    $available_amount = $resp['rest'];
                    $portfolio = $resp['portfolio'];

                    $stackable_amount = $available_amount >= $amount ? $amount : config('smartcontract.min_contract_soax');

                    WalletFacade::update($wallet, [
                        "amount" => ($wallet->amount - $stackable_amount),
                        "is_stackable" => false,
                    ]);
                    $contract = $this->contract->create([
                        "portfolio_id" => $portfolio->id,
                        "customer_id" => $customer->id,
                        "amount" => $stackable_amount,
                    ]);
                    event(new NewStakeEvent($contract, WalletFacade::get($wallet->id)));
                }
            }
        }
    }
    /**
     * Create Contracts
     */
    public function create($request)
    {
        $walletData = WalletFacade::get(Auth::user()->wallet->id);
        $data['amount'] = $walletData['amount'] - $request['amount'];
        $data['customer_id'] = Auth::user()->id;
        WalletFacade::update(WalletFacade::get(Auth::user()->wallet->id), $data);
        $contract = $this->contract->create($request);
        event(new NewStakeEvent($contract, $walletData));
        return $contract;
    }
    /**
     * update
     *
     * @param  mixed $contract
     * @param  mixed $data
     * @return void
     */
    public function update(Contract $contract, array $data)
    {
        $contract->update($this->edit($contract, $data));
    }
    /**
     * edit
     *
     * @param  mixed $contract
     * @param  mixed $data
     * @return mixed
     */
    public function edit(Contract $contract, array $data)
    {
        return array_merge($contract->toArray(), $data);
    }
    /**
     * Create Contracts
     */
    public function getPortfolioSummary($request)
    {
        $data['sales_value'] = 0;
        $data['available_value'] = 0;
        $data['portfolio_value'] = 0;
        $portfolio = PortfolioFacade::get($request['portfolio_id']);
        $data['portfolio_value'] = $portfolio['price'];
        $data['description'] = $portfolio['description'];
        $contracts = $this->contract->where('portfolio_id', $request['portfolio_id'])->get();
        foreach ($contracts as $contract) {
            $data['sales_value'] = $data['sales_value'] + $contract['amount'];
        }
        $data['available_value'] = $portfolio['price'] - $data['sales_value'];
        return $data;
    }
    /**
     * contract Production
     *
     * @return void
     */
    public function contractProduction()
    {
        $data = array();
        $contractProduction = $this->contract->where('customer_id', Auth::user()->id)->get();
        if (count($contractProduction) == 1) {
            array_push($data, 0);
        }
        foreach ($contractProduction as $key => $value) {
            array_push($data, $value['amount']);
        }
        return $data;
    }
    /**
     * transfer To Staked Account
     * !this function only call from listener [QUEUE Listener]
     * @param  mixed $wallet
     * @param  mixed $contract
     * @return void
     */
    public function transferToStakedAccount($wallet, $contract)
    {
        // TODO:have to develop thin function correctly
        // If not transferred forward
        // if ($contract->soax_transferred == false) {
        //     $response =   SOAXStakeFacade::transferSOAXToStakeAccount($contract->amount * 1);
        //     if ($response['status'] == true) {
        //         $this->update($contract, [
        //             'soax_transferred' => 1,
        //             'transaction_id' => $response['resp']->transactionHash,
        //         ]);
        //     }
        // }
    }
    /**
     * Get data Portfolios By Auth
     */
    public function getByAuthPortfolios()
    {
        $contracts = $this->contract->where('customer_id', Auth::user()->id)->get();
        $data = [];
        $temp = [];
        foreach ($contracts as $key => $value) {
            if (!in_array($value->Portfolio->title, $temp)) {
                array_push($temp, $value->Portfolio->title);
                array_push($data, $value->Portfolio);
            }
        }
        return $data;
    }

    /**
     * Get data Portfolios By Auth
     */
    public function getByAuthPortfolio($value)
    {
        $selectedID = null;
        $data['portfolio'] = null;
        $data['contract'] = null;
        $data['product'] = null;
        $data['stakedBalance'] = 0;
        $portfolioPrice = 0;
        $data['sales_value'] = 0;
        $data['productionBalance'] = 0;
        $countI = 0;
        $time = null;
        $data['chartValues'] = array();
        $tempDateArray = array();
        $portfolios = $this->getByAuthPortfolios();
        foreach ($portfolios as $key => $portfolio) {
            if (md5($portfolio['id']) == $value) {
                $selectedID = $portfolio['id'];
                $portfolioPrice = $portfolio['price'];
                $data['portfolio'] = $portfolio;
            }
        }
        $AuthContracts = $this->contract->where('portfolio_id', $selectedID)
            ->where('customer_id', Auth::user()->id)
            ->get();

        $contracts = $this->contract->where('portfolio_id', $selectedID)->get();
        foreach ($contracts as $contract) {
            $data['sales_value'] = $data['sales_value'] + $contract['amount'];
        }
        foreach ($AuthContracts as $key => $contract) {
            $data['stakedBalance'] = $data['stakedBalance'] + $contract['amount'];
            $tempData = ContractProduction::where('contract_id', $contract['id'])->get();
            foreach ($tempData as $key => $tempDataValue) {
                $date = date_create($tempDataValue['date']);
                $tempDate = date_format($date, "Y-m-d");
                if (in_array($tempDate, $tempDateArray)) {
                    foreach ($data['chartValues'] as $keyTT => $TempValueW) {
                        if ($TempValueW['date'] == $tempDate) {
                            $data['chartValues'][$keyTT]['value'] = (float)$TempValueW['value'] + $tempDataValue['amount'];
                        }
                    }
                } else {
                    $tempChart['date'] = date_format($date, "Y-m-d");
                    $tempChart['value'] = $tempDataValue['amount'];
                    array_push($data['chartValues'], $tempChart);
                    array_push($tempDateArray, $tempDate);
                }
            }
        }

        $data['contractCount'] = count($AuthContracts);
        $data['sales_value'] = $data['sales_value'] -  $data['stakedBalance'];
        $data['available_value'] = $portfolioPrice - $data['sales_value'];

        $data['products'] = array();
        $products = ProductionFacade::getProductionByPortfolio($selectedID);
        foreach ($products as $key => $product) {
            $temp1['date'] = Carbon::parse($product->date)->format('M d Y');
            $temp1['sopxProduced'] = number_format($this->getSopxProduced($product->id), 4);

            $production = $product->transferredRate(Auth::user()->id, $product->date);
            $rate = 0;
            if ($production) {
                $rate = $production->rate;
                $rate = $temp1['sopxProduced'] * $rate / 100;
            }

            $temp1['autoConversion'] = number_format($rate, 4);
            $temp1['sopxLeft'] = number_format(($temp1['sopxProduced'] - $rate), 4);
            $temp1['action'] = $this->actionBtn($product->id);
            array_push($data['products'], $temp1);
        }
        if (count($data['chartValues']) == 0) {

            $today = date("Y-m-d");
            $data['chartValues'] = array();
            $tempChart['date'] = $today;
            $tempChart['value'] = 0;
            array_push($data['chartValues'], $tempChart);
        }
        $data['loader'] = $this->loaderHTML();
        $data['productionBalance'] = number_format($data['productionBalance'], 4);

        usort($data['chartValues'], function ($a, $b) {
            return new DateTime($a['date']) <=> new DateTime($b['date']);
        });
        return $data;
    }
    /**
     * totalStakedAmount
     *
     * @return void
     */
    public function totalStakedAmount()
    {
        $users = DB::select('select * from contracts');
        $count = 0;
        foreach ($users as $value) {
            $count = $count + $value->amount;
        }
        return $count;
    }

    /**
     * totalContacts
     *
     * @return void
     */
    public function totalContracts()
    {
        $id = Auth::user()->id;
        return $this->contract->where('customer_id', $id)->count();
    }

    /**
     * totalProductionCount
     *
     * @return void
     */
    public function totalProductionCount()
    {
        $id = Auth::user()->id;
        $data = $this->contractProduction->where('customer_id', $id)->get();
        $sum = 0;
        foreach ($data as $value) {
            $sum = $sum + $value->amount;
        }
        return $sum;
    }

    /**
     * getByAuthProduction
     *
     * @return void
     */
    public function getByAuthProduction()
    {
        $selectedID = null;
        $data['chartValues'] = array();
        $tempDateArray = array();
        $portfolios = $this->getByAuthPortfolios();
        foreach ($portfolios as $key => $portfolio) {
            $selectedID = $portfolio['id'];
            $portfolioPrice = $portfolio['price'];
            $AuthContracts = $this->contract->where('portfolio_id', $selectedID)
                ->where('customer_id', Auth::user()->id)
                ->get();
            foreach ($AuthContracts as $key => $contract) {
                $tempData = ContractProduction::where('contract_id', $contract['id'])->get();
                foreach ($tempData as $key => $tempDataValue) {
                    $date = date_create($tempDataValue['date']);
                    $tempDate = date_format($date, "Y-m-d");
                    if (in_array($tempDate, $tempDateArray)) {
                        foreach ($data['chartValues'] as $keyTT => $TempValueW) {
                            if ($TempValueW['date'] == $tempDate) {
                                $data['chartValues'][$keyTT]['value'] = (float)$TempValueW['value'] + $tempDataValue['amount'];
                            }
                        }
                    } else {
                        $tempChart['date'] = date_format($date, "Y-m-d");
                        $tempChart['value'] = $tempDataValue['amount'];
                        array_push($data['chartValues'], $tempChart);
                        array_push($tempDateArray, $tempDate);
                    }
                }
            }
        }

        $data['loader'] = $this->loaderHTML();
        usort($data['chartValues'], function ($a, $b) {
            return new DateTime($a['date']) <=> new DateTime($b['date']);
        });

        return $data;
    }

    /**
     * getAuthContractsAmount
     *
     * @return void
     */
    public function getAuthContractsAmount()
    {
        $count = 0;
        $contracts = $this->getByAuth();
        foreach ($contracts as $contract) {
            $count = $count + $contract['amount'];
        }
        return  round($count);
    }
    public function getAllStakedAMount($id)
    {
        return $this->contract->getAllStakedAMount($id);
    }

    /**
     * get sopx Produced
     */
    public function getSopxProduced($production_id)
    {
        return $this->contractProduction->getSopxProduced($production_id);
    }

    /**
     * get contracts by production id
     */
    public function getContractByProductId($production_id)
    {
        return $this->contractProduction->getContractByProductId($production_id);
    }
}
