<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-8 col-12 p-4 bg-easy">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <h3 class="text-center gf-title bg-white rounded"><strong>First</strong> Degree</h3>
                            </div>
                            <div class="col-lg-9 col-6 text-right">
                                <a href="{{ route('social.view','1') }}" class=" btn btn-sm btn-neutral float-right">
                                    <i class="fas fa-eye"></i> View Log
                                </a>
                            </div>
                        </div>
                        <div class="row cartRow">
                            <div class="col-lg-9 col-12">
                                <div class="chartdiv" data-value="{{ $cor_reward_degree->points_showing }}"
                                    id="firtDiv1">
                                </div>
                            </div>
                            <div class="col-lg-3 col-12">
                                <div class="card">
                                    <div class="card-body pb-1" data-toggle="tooltip" data-placement="left"
                                        title="Collectable Carbon Offset Rewards">
                                        <span class="collectBtn">
                                            @include('MemberArea.Pages.SocialImpact.Components.dropbtn',['reward'=>$cor_reward_degree,"total"=>$collectible_reward_cor])
                                        </span>
                                        <h3 class="text-left gf-title h3">
                                            {!! $this->ethPan($collectible_reward_cor) !!}
                                        </h3>
                                    </div>
                                    <div class="card-body bg-light p-1" data-toggle="tooltip" data-placement="bottom"
                                        title="Total Carbon Offset Rewards">
                                        <h5 class="text-center h5">
                                            {!! $this->ethPan($total_reward_cor) !!}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="chartdiv" data-value="{{ $geo_reward_degree->points_showing }}"
                                    id="firtDiv2">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body pb-1" data-toggle="tooltip" data-placement="left"
                                        title="Collectable Energytic Rewards">
                                        <span class="collectBtn">
                                            @include('MemberArea.Pages.SocialImpact.Components.dropbtn',['reward'=>$geo_reward_degree,"total"=>$collectible_reward_geo])
                                        </span>
                                        <h3 class="text-left gf-title h3">
                                            {!! $this->ethPan($collectible_reward_geo) !!}
                                        </h3>
                                    </div>
                                    <div class="card-body bg-light p-1" data-toggle="tooltip" data-placement="bottom"
                                        title="Total Energytic Rewards">
                                        <h5 class="text-center h5">
                                            {!! $this->ethPan($total_reward_geo) !!}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="chartdiv" data-value="{{ $oigcc_reward_degree->points_showing }}"
                                    id="firtDiv3">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body pb-1" data-toggle="tooltip" data-placement="left"
                                        title="Collectable Creater Rewards">
                                        <span class="collectBtn">
                                            @include('MemberArea.Pages.SocialImpact.Components.dropbtn',['reward'=>$oigcc_reward_degree,"total"=>$collectible_reward_oigcc])
                                        </span>
                                        <h3 class="text-left gf-title h3">
                                            {!! $this->ethPan($collectible_reward_oigcc) !!}
                                        </h3>
                                    </div>
                                    <div class="card-body bg-light p-1" data-toggle="tooltip" data-placement="bottom"
                                        title="Total Creater Rewards">
                                        <h5 class="text-center h5">
                                            {!! $this->ethPan($total_reward_oigcc) !!}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 p-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-12 mb-4">
                                <h3 class="text-center gf-title">You have helped</h3>
                            </div>
                            <div class="col-lg-8 col-12  mb-2 mt-3 bg-carbon">
                                <h3 class="text-center mt-2 h3  mb-2 gf-subtitle">
                                    <small>Offest </small>
                                    <strong>{{ $cor_reward_points }} lbs</strong>
                                    <small>of Carbon </small>
                                </h3>
                            </div>
                            <div class="col-lg-8  mb-2 mt-3 bg-energy">
                                <h3 class="text-center mt-2 h3 mb-2 gf-subtitle">
                                    <small>Offest </small>
                                    <strong>{{ (strpos($geo_reward_points, "K") !== false) ? ((str_replace("K", "", $geo_reward_points)) . " MW") : ($geo_reward_points . " KW") }}
                                    </strong>
                                    <small>of Energy </small>
                                </h3>
                            </div>
                            <div class="col-lg-8  mb-2 mt-3 bg-job">
                                <h3 class="text-center mt-2 h3 mb-2 gf-subtitle">
                                    <small>Create </small>
                                    <strong>{{ $oigcc_reward_points }}</strong>
                                    <small>#of Job Hours</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
