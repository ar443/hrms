@extends('hrms.layouts.base')

@section('content')
    <!-- START CONTENT -->
    <div class="content">

        <header id="topbar" class="alt">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="breadcrumb-icon">
                        <a href="/dashboard">
                            <span class="fa fa-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-active">
                        <a href="/dashboard"> Dashboard </a>
                    </li>
                    <li class="breadcrumb-link">
                        <a href=""> Employees </a>
                    </li>
                    <li class="breadcrumb-current-item"> Employee Manager</li>
                </ol>
            </div>
        </header>


        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">

            <!-- -------------- Column Center -------------- -->
            <div class="chute chute-center">

                <!-- -------------- Products Status Table -------------- -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title hidden-xs">Employee Probation Period Lists</span><br />
                                </div><br />
                                @if (Session::has('failed'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('failed') }}
                                    </div>
                                @endif


                                <div class="panel-body pn">
                                    @if (Session::has('flash_message'))
                                        <div class="alert alert-success">
                                            {{ Session::get('flash_message') }}
                                        </div>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table allcp-form theme-warning tc-checkbox-1 fs13">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="text-center">No.</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Date of Joining</th>
                                                    <th class="text-center">Probation ends on</th>
                                                    <th class="text-center">Remaning Days</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $key => $emp)
                                                    @php
                                                        $joningDate = \Carbon\Carbon::parse($emp->date_of_joining);
                                                        $joningDateCheck = \Carbon\Carbon::parse($emp->date_of_joining);

                                                        $remainingDays = $joningDateCheck->addMonth(3)->diffInDays(now(),true);
                                                    @endphp
                                                    <tr class="@if ($remainingDays == 0) success @endif">
                                                        <td class="text-center">{{ $key + 1 }}</td>

                                                        <td class="text-center">
                                                            <a href="{{ route('edit-emp', $emp->user->id) }}">{{ $emp->name }}
                                                            </a>
                                                        </td>

                                                        <td class="text-center">
                                                            {{ $joningDate->format('d-M-Y') }}
                                                        </td>


                                                        <td class="text-center">
                                                            {{ $joningDate->addDay(90)->format('d-M-Y') }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $remainingDays}}
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
