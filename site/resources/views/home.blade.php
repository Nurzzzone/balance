@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">История платежей</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-bordered border-top-0 mb-0">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0 align-middle">value</th>
                                    <th class="border-bottom-0 align-middle">balance</th>
                                    <th class="border-bottom-0 align-middle">time</th>
                                    <th class="border-bottom-0 align-middle">date</th>
                                </tr>
                            </thead>
                            <tbody id="balanceHistory"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
