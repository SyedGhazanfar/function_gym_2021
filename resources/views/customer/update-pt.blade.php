<style>
    .bootstrap-select.form-control-lg .dropdown-toggle {
        border: 0px none !important;
        padding: 0.9rem 1rem !important;
        font-size: 15px !important;
    }
    
    .wizard>.steps>ul>li {
        width: 33% !important;
    }
</style>

{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
@if(session('user'))
<div class="alert alert-success" role="alert">
    <strong>Success! </strong>Data Inserted Successfully.
</div>

@elseif(session('error'))
<div class="alert alert-success" role="alert">
    <strong>Error! </strong>Something went wrong!.
</div>

@endif

<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item "><a href="javascript:void(0)">Customers</a></li>
            <li class="breadcrumb-item "><a href="javascript:void(0)">Manage Customers</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update PT Customers</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update PT Details</h4>
                </div>
                <div class="card-body h-100">
                    <form action="/update-pt" id="step-form-horizontal" class="step-form-horizontal" method="POST">


                        <div>
                            @csrf
                            <input type="text" value="{{$datas->id}}" name="id" hidden>
                            <section class="pl-2 pr-2">
                                <div class="heading-section mb-3">
                                    <h4>General Information</h4>
                                    <hr />
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="text-label">Name of Customer</label>
                                            <select name="customer_id" id="single-select" disabled class="disable form-control disable new-lg form-control-lg">
                                                <option value="{{$datas->id}}">{{$datas->first_name . ' '. $datas->last_name}}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">

                                        <div class="form-group mb-4">
                                            <label class="text-label">Tell me about your current activity level</label>
                                            <select name="activity" class="form-control form-control-lg">
                                                <option hidden value="{{$datas->current_activity_level}}">{{$datas->current_activity_level}}</option>
                                                <option value="minimal">Minimal</option>
                                                <option value="low">Low</option>
                                                <option value="moderate">Moderate</option>
                                                <option value="high">High</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-label">Tell me about your family and occupational life, what do you for a living? What does a day look like in your life?</label>
                                            <textarea type="text" name="dailyroutine" class="form-control text-area-hight" placeholder="Describe Briefly...">{{$datas->daily_routine}}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group mb-4">
                                            <label class="text-label">Do you have any medical condition</label>
                                            <select name="medicon" id="medicon" class="form-control form-control-lg">
                                                <option value="{{$datas->medical_condition}}" hidden>{{$datas->medical_condition}}</option>
                                                <option value="no">No</option>
                                                <option value="yes">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-label">Describe</label>
                                            <textarea type="text" id="medicon-desc" name="injury" class="form-control text-area-hight" placeholder="Describe Briefly...">{{$datas->medical_condition_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="text-label">Have you had any injuries previously? Please give a clear timeline and description.</label>
                                            <textarea type="text" name="prev_injury" class="form-control text-area-hight" placeholder="Describe Briefly...">{{$datas->prev_injury}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="text-label">What kind of exercise have you done previously? Please go in order, starting from the very beginning and ending at your most recent training regimen. </label>
                                            <textarea type="text" name="preexcersice" class="form-control text-area-hight" placeholder="Describe Briefly...">{{$datas->previous_excersice}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="text-label">Please tell us your diet</label>
                                            <textarea type="text" name="dailydiet" class="form-control text-area-hight" placeholder="Describe Briefly...">{{$datas->daily_diet}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="pl-2 pr-2">
                                <div class="heading-section mb-3 ">
                                    <h4>Initial Assessment</h4>
                                    <hr />
                                </div>
                                
                                <!-- Funtional Screening accordion -->
                                <div id="accordion-one" class="accordion accordion-primary">
                                    <div class="accordion__item">
                                        <div class="accordion__header rounded-lg" data-toggle="collapse" data-target="#default_collapseOne">
                                            <span class="accordion__header--text">Funtional Screening</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="default_collapseOne" class="collapse accordion__body show" data-parent="#accordion-one">
                                            <div class="accordion__body--text">
                                                <div class="heading-section mb-3 mt-4">
                                                    <h4>TVA/Core Activation </h4>
                                                    <hr />
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-6 mb-2 ">
                                                        <div class="form-group ">
                                                            <p>Can they lie down supine/face up and keep hand under back and squeeze core while keeping back flat?</p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 pt-2">
                                                                <div class="row">
                                                                    @if($datas->test1_core_activation == 'yes')
                                                                    <div class="col-6">
                                                                        <input type="radio" value="yes" id="tva-1-1" name="tva1" checked>
                                                                        <label for="tva-1-1">Yes</label>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" value="no" id="glute-2-1" name="tva1">
                                                                        <label for="glute-2-1">No</label>
                                                                    </div>
                                                                    @elseif($datas->test1_core_activation == 'no' || $datas->test1_core_activation == null)
                                                                    <div class="col-6">
                                                                        <input type="radio" value="yes" id="tva-1-1" name="tva1">
                                                                        <label for="tva-1-1">Yes</label>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" value="no" id="glute-2-1" name="tva1" checked>
                                                                        <label for="glute-2-1">No</label>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="tva_1_com" placeholder="Comment" value="{{$datas->test1_core_activation_description}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-lg-6 mb-2 ">
                                                        <div class="form-group ">
                                                            <p>Can they do bird dogs with the leg movement coming from glute (like donkey kick) and is the body in straight line without arching back?</p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-3 pt-lg-2">
                                                                <div class="row">
                                                                    @if($datas->test2_core_activation == 'yes')
                                                                    <div class="col-6">
                                                                        <input type="radio" id="tva-2-1" value="yes" name="tva2" checked>
                                                                        <label for="tva-2-1">Yes</label>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" id="tva-2-2" value="no" name="tva2">
                                                                        <label for="tva-2-2">No</label>
                                                                    </div>
                                                                    @elseif($datas->test2_core_activation == 'no' || $datas->test2_core_activation == null)
                                                                    <div class="col-6">
                                                                        <input type="radio" id="tva-2-1" value="yes" name="tva2" checked>
                                                                        <label for="tva-2-1">Yes</label>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" id="tva-2-2" value="no" checked name="tva2">
                                                                        <label for="tva-2-2">No</label>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="tva_2_com" placeholder="Comment" value="{{$datas->test2_core_activation_description}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-6 mt-4">
                                                        <div class="form-group mb-4">
                                                            <label class="text-label">Level of Abs Strength</label>
                                                            <select name="absstrength" class="form-control form-control-lg" id="coreweak">
                                                                <option hidden value="{{$datas->strength_core_activation}}">{{$datas->strength_core_activation}}</option>
                                                                <option value="weak">Weak</option>
                                                                <option value="moderate">Moderate</option>
                                                                <option value="strong">Strong</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 mt-4">
                                                        <div class="form-group">
                                                            <label class="text-label">If weak core activation, Describe Briefly</label>
                                                            <textarea type="text" name="weakcore" class="form-control text-area-hight" placeholder="Describe Briefly...">{{$datas->strength_core_activation_description}}</textarea>
                                                        </div>
                                                    </div>

                                                </div>



                                                <div class="heading-section mb-3 mt-4">
                                                    <h4> Glute activation </h4>
                                                    <hr />
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-6 mb-2 ">
                                                        <div class="form-group ">
                                                            <p>Are they able to do a bridge from just squeezing their glutes and not using their back? Ask them to stop and repeat at full squeeze. About 2 sets of 10 reps.</p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 pt-2">
                                                                <div class="row">
                                                                    @if($datas->test_glute_activation=='yes')
                                                                    <div class="col-6">
                                                                        <input type="radio" id="glute-1-1" name="glute" value="yes" checked>
                                                                        <label for="glute-1-1">Yes</label>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" id="glute-2" name="glute" value="no">
                                                                        <label for="glute-2">No</label>
                                                                    </div>
                                                                    @elseif($datas->test_glute_activation=='no' || $datas->test_glute_activation==null)

                                                                    <div class="col-6">
                                                                        <input type="radio" id="glute-1-1" name="glute" value="yes" checked>
                                                                        <label for="glute-1-1">Yes</label>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" id="glute-2" name="glute" checked value="no">
                                                                        <label for="glute-2">No</label>
                                                                    </div>

                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="glute_com" placeholder="Comment" value="{{$datas->test_glute_activation_description}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-lg-6 mt-4">
                                                        <div class="form-group mb-4">
                                                            <label class="text-label">Level of Glute Strength</label>
                                                            <select name="glutestrength" class="form-control form-control-lg" id="gluteweak">
                                                                <option hidden value="{{$datas->strength_glute_activation}}">{{$datas->strength_glute_activation}}</option>
                                                                <option value="weak">Weak</option>
                                                                <option value="moderate">Moderate</option>
                                                                <option value="strong">Strong</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mt-4 ">
                                                        <div class="form-group">
                                                            <label class="text-label">If weak Glute activation, Describe Briefly</label>
                                                            <textarea type="text" name="glutecore" class="form-control text-area-hight" placeholder="Describe Briefly...">{{$datas->strength_glute_activation_description}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>




                                                <div class="heading-section mb-3 mt-4">
                                                    <h4>Clamshells/Lateral Banded Walk </h4>
                                                    <hr />
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-6 mb-2 ">
                                                        <div class="form-group ">
                                                            <p>Are they able to use the glute medius to perform the movement</p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 pt-2">
                                                                <div class="row">
                                                                    @if($datas->test_clamshells_activation=='yes')
                                                                    <div class="col-6">
                                                                        <input type="radio" id="clamshell-1-1" checked name="clamshell" value="yes">
                                                                        <label for="clamshell-1-1">Yes</label>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" id="clamshell-2" name="clamshell" value="no">
                                                                        <label for="clamshell-2">No</label>
                                                                    </div>
                                                                    @elseif($datas->test_clamshells_activation=='no' || $datas->test_clamshells_activation==null)
                                                                    <div class="col-6">
                                                                        <input type="radio" id="clamshell-1-1" name="clamshell" value="yes">
                                                                        <label for="clamshell-1-1">Yes</label>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" id="clamshell-2" checked name="clamshell" value="no">
                                                                        <label for="clamshell-2">No</label>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="clamshell_com" value="{{$datas->test_clamshells_activation_description}}" placeholder="Comment">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-lg-6 mt-4">
                                                        <div class="form-group mb-4">
                                                            <label class="text-label">Level of clamshell Strength</label>
                                                            <select name="clamshellstrength" class="form-control form-control-lg" id="clamshellweak">
                                                                <option hidden value="{{$datas->strength_clamshells_activation}}">{{$datas->strength_clamshells_activation}}</option>
                                                                <option value="weak">Weak</option>
                                                                <option value="moderate">Moderate</option>
                                                                <option value="strong">Strong</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mt-4">
                                                        <div class="form-group">
                                                            <label class="text-label">If weak clamshell activation, Describe Briefly</label>
                                                            <textarea type="text" name="clamshellcore" class="form-control text-area-hight" placeholder="Describe Briefly...">{{$datas->strength_clamshells_activation_description}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mt-3">
                                                    <div class="col-lg-4 mb-2">
                                                        <div class="form-group">
                                                            <p class="text-primary">Upright posture</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <select name="sc1" class="form-control form-control-lg" id="sc1">
                                                                <option value="{{$datas->squat_test_1}}" hidden>{{$datas->squat_test_1}}</option>
                                                                <option value="no">No</option>
                                                                <option value="yes">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Describe..." name="sc1_desc" value="{{$datas->squat_test_1_desc}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-lg-4 mb-2">
                                                        <div class="form-group">
                                                            <p class="text-primary">Bracing core correctly</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <select name="sc2" class="form-control form-control-lg" id="sc2">
                                                                <option value="{{$datas->squat_test_2}}" hidden>{{$datas->squat_test_2}}</option>
                                                                <option value="no">No</option>
                                                                <option value="yes">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Describe..." name="sc2_desc" value="{{$datas->squat_test_2_desc}}">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mt-3">
                                                    <div class="col-lg-4 mb-2">
                                                        <div class="form-group">
                                                            <p class="text-primary">Weight distributed evenly</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <select name="sc3" class="form-control form-control-lg" id="sc3">
                                                                <option value="{{$datas->squat_test_3}}" hidden>{{$datas->squat_test_3}}</option>
                                                                <option value="no">No</option>
                                                                <option value="yes">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Describe..." name="sc3_desc" value="{{$datas->squat_test_3_desc}}">
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row mt-3">
                                                    <div class="col-lg-4 mb-2">
                                                        <div class="form-group">
                                                            <p class="text-primary">Hips rotate externally</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <select name="sc4" class="form-control form-control-lg" id="sc4">
                                                                <option value="{{$datas->squat_test_4}}" hidden>{{$datas->squat_test_4}}</option>
                                                                <option value="no">No</option>
                                                                <option value="yes">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Describe..." value="{{$datas->squat_test_4_desc}}" name="sc4_desc">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mt-3">
                                                    <div class="col-lg-4 mb-2">
                                                        <div class="form-group">
                                                            <p class="text-primary">Exploding up properly</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <select name="sc5" class="form-control form-control-lg" id="sc5">
                                                                <option value="{{$datas->squat_test_5}}" hidden>{{$datas->squat_test_5}}</option>
                                                                <option value="no">No</option>
                                                                <option value="yes">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Describe..." value="{{$datas->squat_test_5_desc}}" name="sc5_desc">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mt-3">
                                                    <div class="col-lg-4 mb-2">
                                                        <div class="form-group">
                                                            <p class="text-primary">Squeezing glutes properly</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <select name="sc6" class="form-control form-control-lg" id="sc6">
                                                                <option value="{{$datas->squat_test_6}}" hidden>{{$datas->squat_test_6}}</option>
                                                                <option value="no">No</option>
                                                                <option value="yes">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Describe..." name="sc6_desc" value="{{$datas->squat_test_6_desc}}">
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row mt-3">
                                                    <div class="col-lg-4 mb-2">
                                                        <div class="form-group">
                                                            <p class="text-primary">Can they brace their core? </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <select name="sc7" class="form-control form-control-lg" id="sc8">
                                                                <option value="{{$datas->squat_test_7}}" hidden>{{$datas->squat_test_7}}</option>
                                                                <option value="no">No</option>
                                                                <option value="yes">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Describe..." name="sc7_desc" value="{{$datas->squat_test_7_desc}}">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mt-3">
                                                    <div class="col-lg-4 mb-2">
                                                        <div class="form-group">
                                                            <p class="text-primary">Can they keep their spine neutral? </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <select name="sc8" class="form-control form-control-lg" id="sc8">
                                                                <option value="{{$datas->squat_test_8}}" hidden>{{$datas->squat_test_8}}</option>
                                                                <option value="no">No</option>
                                                                <option value="yes">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Describe..." name="sc8_desc" value="{{$datas->squat_test_8_desc}}">
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row mt-3">
                                                    <div class="col-lg-4 mb-2">
                                                        <div class="form-group">
                                                            <p class="text-primary"> Are they able to squat to parallel at least? </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <select name="sc9" class="form-control form-control-lg" id="sc9">
                                                                <option value="{{$datas->squat_test_9}}" hidden>{{$datas->squat_test_9}}</option>
                                                                <option value="no">No</option>
                                                                <option value="yes">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Describe..." name="sc9_desc" value="{{$datas->squat_test_9_desc}}">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="heading-section mb-3 mt-4">
                                                    <h4>Sqaut </h4>
                                                    <hr />
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-6 mt-3">
                                                        <div class="form-group mb-4">
                                                            <label class="text-label">Level of Squat Strength</label>
                                                            <select name="squatstrength" class="form-control form-control-lg" id="squatweak">
                                                                <option hidden value="{{$datas->strength_squat_activation}}">{{$datas->strength_squat_activation}}</option>
                                                                <option value="weak">Weak</option>
                                                                <option value="moderate">Moderate</option>
                                                                <option value="strong">Strong</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mt-4">
                                                        <div class="form-group">
                                                            <label class="text-label">If weak squat activation, Describe Briefly</label>
                                                            <textarea type="text" name="squatcore" class="form-control text-area-hight" placeholder="Describe Briefly...">{{$datas->strength_squat_activation_description}}</textarea>
                                                        </div>
                                                    </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Body Measurement accordion -->
                                <div id="accordion-two" class="accordion accordion-primary">
                                    <div class="accordion__item">
                                        <div class="accordion__header rounded-lg" data-toggle="collapse" data-target="#default_collapseTwo">
                                            <span class="accordion__header--text">Measurements and Body Statistics</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="default_collapseTwo" class="collapse accordion__body show" data-parent="#accordion-two">
                                            <div class="accordion__body--text">
                                                <div class="heading-section mb-3 mt-4">
                                                    <h4>Measurement </h4>
                                                    <hr />
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-3 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">Calculation Unit</label>
                                                            <select name="mcal" class="form-control form-control-lg" id="mcal">
                                                                <option value="{{$datas->measurement_cal_unit}}" hidden>{{$datas->measurement_cal_unit}}</option>
                                                                <option value="cm">Centimeter (cm)</option>
                                                                <option value="inch">Inches (inch)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">Chest</label>
                                                            <input type="text" name="chest" class="form-control" value="{{$datas->chest}}" placeholder="56">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">Waist</label>
                                                            <input type="text" class="form-control" placeholder="86" name="waist" value="{{$datas->waist}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">Hips</label>
                                                            <input type="text" name="hips" class="form-control" value="{{$datas->hips}}" placeholder="36">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="heading-section mb-3 mt-4">
                                                    <h4>Body Statistics</h4>
                                                    <hr />
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-3 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">Weight Unit</label>
                                                            <select name="weight_unit" class="form-control form-control-lg" id="bweight">
                                                                <option value="{{$datas->weight_cal_unit}}" hidden>{{$datas->weight_cal_unit}}</option>
                                                                <option value="kilogram">Kilogram</option>
                                                                <option value="pound">Pounds</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">Body Weight</label>
                                                            <input type="number" min="0" name="weight" value="{{$datas->body_weight}}" class="form-control" placeholder="56">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">Body FAT %</label>
                                                            <input type="number" min="0" class="form-control" value="{{$datas->body_fat}}" placeholder="86" name="fat">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">Muscles Mass %</label>
                                                            <input type="number" min="0" name="muscles" class="form-control" value="{{$datas->muscles_mass}}" placeholder="16">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>





                           

                            </section>

                            <footer>
                                <div class="row">
                                    <div class="btn-group ml-auto">
                                        {{-- <a href="{{url('manage-customer')}}" class="btn btn-md ml-auto mt-3 btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a> --}}
                                        <button type="submit" class="btn btn-md mt-3 mr-2 btn-primary"><i class="fa fa-clipboard" aria-hidden="true"></i> Update</button>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection