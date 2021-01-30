<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcController extends Controller
{
    public function index(request $request)
    {
        $response['formLoaded'] = false;
        $response['soax']    =    null;
        $response['price'] =   null;
        $response['ratio']   =   null;
        $response['month']   =   null;

        if ($request->has('soax') && $request->has('price') && $request->has('ratio') && $request->has('month')) {
            $response = $this->calNow($request->soax * 1, $request->price * 1, $request->ratio * 1, $request->month * 1);
        }

        return view('PublicArea.Pages.Calc.index')->with($response);
    }
    /**
     * calNow
     *
     * @param  mixed $initialSoax
     * @param  mixed $estimatedValue
     * @param  mixed $sopxConversationRatio
     * @return void
     */
    public function calNow($initialSoax, $estimatedValue, $sopxConversationRatio, $cmpMonths)
    {
        $response['formLoaded'] = true;
        $resultArrTemp = [];
        $totalWithdrawal = 0;
        $totalRevenue = 0;
        for ($i = 0; $i < $cmpMonths; $i++) {
            if ($i < 1) {
                $val = $this->findInterest($initialSoax, $estimatedValue, $sopxConversationRatio, 0, []);
            } else {
                if ($sopxConversationRatio > 0) {
                    $compound = ($val['mntlyOilRevenue'] * $sopxConversationRatio / 100) / 0.10;
                    $newCompoundSox = $val['soax'] + $compound;
                    $val = $this->findInterest($newCompoundSox, $estimatedValue, $sopxConversationRatio, $i, $val['soax']);
                }
            }

            $resultArr[] = $val;
        }

        if ($cmpMonths < 120) {
            $endKey = key(array_slice($resultArr, -1, 1, true));

            for ($c = $endKey + 1; $c < 120; $c++) {
                $rLastKey = key(array_slice($resultArr, -1, 1, true));
                $newInitialSoax = $resultArr[$rLastKey]['soax'];
                $newval = $this->findDdInterest($newInitialSoax, $estimatedValue);
                $resultArr[] = $newval;
            }
        }

        if (!empty($resultArr)) {
            $lastKey = key(array_slice($resultArr, -1, 1, true));
            $deductionArr   =   [];
            if ($lastKey > 0) {
                for ($j = 0; $j <= $lastKey; $j++) {

                    if ($j == 0) {
                        if (isset($resultArr[$j]) && isset($resultArr[$lastKey])) {
                            $newInitialSoax = $resultArr[$lastKey]['soax'] - $resultArr[0]['soax'];
                            $newval = $this->findDdInterest($newInitialSoax, $estimatedValue);
                            $deductionArr[] = $newval;
                        }
                    } else {
                        if (!empty($deductionArr)) {
                            $lastDdKey = key(array_slice($deductionArr, -1, 1, true));
                            $deductionVal = isset($resultArr[$j]['newSoax']) ? $resultArr[$j]['newSoax'] : 0;
                            $newInitialSoax = round(ceil(($deductionArr[$lastDdKey]['soax'] - $deductionVal) * 1000) / 1000, 2);
                            $newval = $this->findDdInterest($newInitialSoax, $estimatedValue);
                            if ($newval['soax'] > 0) {
                                $deductionArr[] = $newval;
                            }
                        }
                    }
                }
            }
        }

        $finalArr = [];
        if (!empty($resultArr)) {
            foreach ($resultArr as $key => $compondAdd) {
                $finalArr[] = $compondAdd;
            }
        }

        if (!empty($deductionArr)) {
            foreach ($deductionArr as $key => $compondDdd) {
                $finalArr[] = $compondDdd;
            }
        }

        $chartLimit = count($finalArr);

        $revenueChartData = [];
        $withdrwalChartData = [];
        if (!empty($finalArr)) {
            foreach ($finalArr as $key => $rst) {
                $totalWithdrawal += $rst['mntlyWithdrawal'];
                $totalRevenue += $rst['mntlyOilRevenue'];
                $revenueChartData[] = $totalRevenue;
                $withdrwalChartData[] = $rst['mntlyWithdrawal'];
            }
        }
        // !test dta
        $compoundSum = $totalWithdrawal;
        if (!empty($deductionArr)) {
            foreach ($deductionArr as $key => $compondDdd) {
                $totalRevenue += $compondDdd['mntlyWithdrawal'];
                $compoundSum += $compondDdd['mntlyWithdrawal'];
                $revenueChartData[] = $compoundSum;
                $withdrwalChartData[] = $compondDdd['mntlyWithdrawal'];
            }
        }
        $monthfe = 120 + $cmpMonths;
        $response['months'] = [];
        for ($i = 0; $i < $monthfe; $i = $i + 6) {

            $response['months'][] = "Month" . $i;
        }

        $response['chart_data_withdrawals'] = [];
        if ($withdrwalChartData) {
            for ($wi = 0; $wi < $monthfe; $wi = $wi + 6) {
                if (isset($withdrwalChartData[$wi])) {
                    $response['chart_data_withdrawals'][] = $withdrwalChartData[$wi];
                }
            }
        }
        $lastWDdKey = key(array_slice($withdrwalChartData, -1, 1, true));
        $response['chart_data_withdrawals'][] = $withdrwalChartData[$lastWDdKey];

        $response['chart_data_revenue'] = [];
        if ($revenueChartData) {
            for ($ri = 0; $ri < $monthfe; $ri = $ri + 6) {
                if (isset($revenueChartData[$ri])) {
                    $response['chart_data_revenue'][] = $revenueChartData[$ri];
                }
            }
        }
        $lastRDdKey = key(array_slice($revenueChartData, -1, 1, true));
        $response['chart_data_revenue'][] = $revenueChartData[$lastRDdKey];


        $total = $totalWithdrawal;
        $response['soax']   =    $initialSoax;
        $response['price'] =   $estimatedValue;
        $response['ratio']   =   $sopxConversationRatio;
        $response['month']   =   $cmpMonths;
        $response['total']   =   $total;
        $response['resultArr']   =   $resultArr;
        $response['deductionArr']   =   $deductionArr;
        return $response;
    }
    /**
     * findInterest
     *
     * @param  mixed $initialSoax
     * @param  mixed $estimatedValue
     * @param  mixed $sopxConversationRatio
     * @param  mixed $initial
     * @param  mixed $previousSoax
     * @return void
     */
    public function findInterest($initialSoax, $estimatedValue, $sopxConversationRatio = 0, $initial = 0, $previousSoax = 0)
    {

        $exptDailySopx  =   (($initialSoax * 3.2) / 1000000);
        $mntlyOilRevenue   =   ($exptDailySopx * ($estimatedValue - 18) * 30.4);

        $exptDailySopx  = round(ceil($exptDailySopx * 1000) / 1000, 2);
        $mntlyOilRevenue  = (round(ceil($mntlyOilRevenue * 1000) / 1000, 2));


        $mntlyWithdrawal = $mntlyOilRevenue;
        if ($sopxConversationRatio > 0) {
            $mntlyWithdrawal = $mntlyOilRevenue - (($mntlyOilRevenue * $sopxConversationRatio) / 100);
            $mntlyWithdrawal  = (round(ceil($mntlyWithdrawal * 1000) / 1000, 2));
        }

        if ($initial < 1) {
            $newSoax = $initialSoax;
        } else {
            $newSoax = $initialSoax - $previousSoax;
        }


        $returnArr  =   array('soax' => $initialSoax, 'exptDailySopx' => $exptDailySopx, 'newSoax' => $newSoax, 'mntlyOilRevenue' => $mntlyOilRevenue, 'mntlyWithdrawal' => $mntlyWithdrawal);
        return $returnArr;
    }

    /**
     * findDdInterest
     *
     * @param  mixed $initialSoax
     * @param  mixed $estimatedValue
     * @return void
     */
    public function findDdInterest($initialSoax, $estimatedValue)
    {
        $exptDailySopx  =   (($initialSoax * 3.2) / 1000000);
        $mntlyOilRevenue   =   ($exptDailySopx * ($estimatedValue - 18) * 30.4);

        $exptDailySopx  = round(ceil($exptDailySopx * 1000) / 1000, 2);
        $mntlyOilRevenue  = round(ceil($mntlyOilRevenue * 1000) / 1000, 2);

        $returnArr  =   array('soax' => $initialSoax, 'exptDailySopx' => $exptDailySopx, 'newSoax' => 0, 'mntlyOilRevenue' => $mntlyOilRevenue, 'mntlyWithdrawal' => $mntlyOilRevenue);
        return $returnArr;
    }
}
