@extends('admin.master')

@section('title', 'Dashboard')


@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow bg-primary text-white border-0">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary-light">
                                            <i class="fe fe-16 fe-shopping-bag text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-0">Balance</p>
                                        <span class="h3 mb-0 text-white">${{ $balance }}</span>
                                        <span class="small text-muted">+5.5%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary">
                                            <i class="fe fe-16 fe-shopping-cart text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-muted mb-0">Orders</p>
                                        <span class="h3 mb-0"> {{ $orders_count }} </span>
                                        <span class="small text-success">+4.5%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary">
                                            <i class="fe fe-16 fe-dollar-sign text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <p class="small text-muted mb-0">Monthly Sales</p>
                                        <div class="row align-items-center no-gutters">
                                            <div class="col-auto">
                                                <span class="h3 mr-2 mb-0"> ${{ $monthly_sales }} </span>
                                            </div>
                                            <div class="col-md-12 col-lg">
                                                <div class="progress progress-sm mt-2" style="height:3px">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 87%" aria-valuenow="87" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary">
                                            <i class="fe fe-16 fe-activity text-white mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <p class="small text-muted mb-0">AVG Orders</p>
                                        <span class="h3 mb-0">${{ $AVG_orders }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end section -->


                <div class="row align-items-center my-2">
                    <div class="col-auto ml-auto">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="reportrange" class="sr-only">Date Ranges</label>
                                <div id="reportrange" class="px-2 py-2 text-muted">
                                    <i class="fe fe-calendar fe-16 mx-2"></i>
                                    <span class="small"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-sm"><span
                                        class="fe fe-refresh-ccw fe-12 text-muted"></span></button>
                                <button type="button" class="btn btn-sm"><span
                                        class="fe fe-filter fe-12 text-muted"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- charts-->
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="chart-box">
                            <div id="columnChart"></div>
                        </div>
                    </div> <!-- .col -->
                </div> <!-- end section -->

                <!-- info small box -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <p class="mb-0"><strong class="mb-0 text-uppercase text-muted">Today</strong></p>
                                <h3 class="mb-0">${{$today_sales}}</h3>
                                <p class="text-muted">+18.9% Last week</p>
                                <div class="chart-box mt-n5">
                                    <div id="lineChartWidget"></div>
                                </div>
                                </div> <!-- .card-body -->
                        </div> <!-- .card -->
                    </div> <!-- .col-md -->
                </div> <!-- / .row -->


                
                <div class="row">
                    <!-- Recent orders -->
                    <div class="col-md-12">
                        <h6 class="mb-3">Last orders</h6>
                        <table class="table table-borderless table-striped">
                            <thead>
                                <tr role="row">
                                    <th>ID</th>
                                    <th>Purchase Date</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col">1331</th>
                                    <td>2020-12-26 01:32:21</td>
                                    <td>Kasimir Lindsey</td>
                                    <td>(697) 486-2101</td>
                                    <td>996-3523 Et Ave</td>
                                    <td>$3.64</td>
                                    <td> Paypal</td>
                                    <td>Shipped</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Remove</a>
                                                <a class="dropdown-item" href="#">Assign</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">1156</th>
                                    <td>2020-04-21 00:38:38</td>
                                    <td>Melinda Levy</td>
                                    <td>(748) 927-4423</td>
                                    <td>Ap #516-8821 Vitae Street</td>
                                    <td>$4.18</td>
                                    <td> Paypal</td>
                                    <td>Pending</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Remove</a>
                                                <a class="dropdown-item" href="#">Assign</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">1038</th>
                                    <td>2019-06-25 19:13:36</td>
                                    <td>Aubrey Sweeney</td>
                                    <td>(422) 405-2736</td>
                                    <td>Ap #598-7581 Tellus Av.</td>
                                    <td>$4.98</td>
                                    <td>Credit Card </td>
                                    <td>Processing</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Remove</a>
                                                <a class="dropdown-item" href="#">Assign</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">1227</th>
                                    <td>2021-01-22 13:28:00</td>
                                    <td>Timon Bauer</td>
                                    <td>(690) 965-1551</td>
                                    <td>840-2188 Placerat, Rd.</td>
                                    <td>$3.46</td>
                                    <td> Paypal</td>
                                    <td>Processing</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Remove</a>
                                                <a class="dropdown-item" href="#">Assign</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">1956</th>
                                    <td>2019-11-11 16:23:17</td>
                                    <td>Kelly Barrera</td>
                                    <td>(117) 625-6737</td>
                                    <td>816 Ornare, Street</td>
                                    <td>$4.16</td>
                                    <td>Credit Card </td>
                                    <td>Shipped</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Remove</a>
                                                <a class="dropdown-item" href="#">Assign</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">1669</th>
                                    <td>2021-04-12 07:07:13</td>
                                    <td>Kellie Roach</td>
                                    <td>(422) 748-1761</td>
                                    <td>5432 A St.</td>
                                    <td>$3.53</td>
                                    <td> Paypal</td>
                                    <td>Shipped</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Remove</a>
                                                <a class="dropdown-item" href="#">Assign</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">1909</th>
                                    <td>2020-05-14 00:23:11</td>
                                    <td>Lani Diaz</td>
                                    <td>(767) 486-2253</td>
                                    <td>3328 Ut Street</td>
                                    <td>$4.29</td>
                                    <td> Paypal</td>
                                    <td>Pending</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Remove</a>
                                                <a class="dropdown-item" href="#">Assign</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- / .col-md-3 -->
                </div> <!-- end section -->
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection
