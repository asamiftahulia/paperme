@extends('master')
@section('content')
            <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Material Dashboard Heading</h4>
                                    <p class="category">Created using Roboto Font Family</p>
                                </div>
                                <div class="card-content">
                                    <div id="typography">
                                        <div class="title">
                                            <h2>Typography</h2>
                                        </div>
                                        <div class="row">
                                            <div class="tim-typo">
                                                <h1>
                                                    <span class="tim-note">Header 1</span>The Life of Material Dashboard </h1>
                                            </div>
                                            <div class="tim-typo">
                                                <h2>
                                                    <span class="tim-note">Header 2</span>The life of Material Dashboard </h2>
                                            </div>
                                       <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#largeModal">MODAL - LARGE SIZE</button>

            <!-- Large Size -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Customer 
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect">New </button>
                    <button type="button" class="btn btn-link waves-effect">Existing </button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection