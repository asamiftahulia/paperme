@extends('master')
@section('page-title','Form Master Bank')
@section('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Bank</h4>
                                    <p class="category">Master Data Bank</p>
                                </div>
                                <div class="card-content">
                                    <form action="{{route('masterbank.store')}}" method="post">
                                             {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Name Bank</label>
                                                    <input type="text" class="form-control" name="name_bank">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                                         <a href="{{URL::to('./')}}" class="btn btn-primary  waves-effect">Back</a>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection