<?php

namespace domain\Portfolio;

use domain\Facades\PortfolioFacade;
use infrastructure\Facades\ImagesFacade;
use infrastructure\Facades\ImageCropperFacade;
use App\Models\Portfolio;
use App\Models\Image;
use Illuminate\Support\Facades\File;

/**
 * Created by PhpStorm.
 * User: Speralabs
 * Date: 10/07/2020
 * Time: 02:10 PM
 */
class PortfolioService
{
    protected $portfolio;


    public function __construct()
    {
        $this->portfolio = new Portfolio();
    }

    /**
     * Get Publish Portfolios
     */
    public function publishData()
    {
        return $this->portfolio->where('status', 1)->get();
    }

    /**
     * Get Publish Portfolios
     */
    public function get($id)
    {
        return $this->portfolio->find($id);
    }
    /**
     * Get Available Contracts
     *
     * @param  mixed $amount
     * @return void
     */
    public function getAvailableContracts($amount)
    {
        foreach ($this->all() as $portfolio) {
            $staked_amount = $portfolio->contractSum();
            $rest = $portfolio->price - $staked_amount;
            if ($rest >= $amount || $rest >= config('smartcontract.min_contract_soax')) {
                return ['portfolio' => $portfolio, 'rest' => $rest];
            }
        }
    }
    /**
     * Get All Portfolios
     */
    public function all()
    {
        return $this->portfolio->all();
    }

    /**
     * Check Slug Validation
     * @param $request
     */
    public function ckeckSlug($request)
    {
        if ($request->get('slug')) {

            $slug = $request->get('slug');

            $data = $this->portfolio->where('slug', $slug)->count();

            if ($data > 0) {
                echo 'not_unique';
            } else {
                echo 'unique';
            }
        }
    }

    /**
     * Search Portfolios
     * @param $request
     */
    public function search($request)
    {
        $portfolio = $this->portfolio->query()
            ->where('title', 'LIKE', "%{$request['title']}%")
            ->where('status', 1)
            ->simplePaginate(8);
        return  $portfolio;
    }
}
