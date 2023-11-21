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
                                    <span class="panel-title hidden-xs">Employee Upcomming Birthdays Lists</span><br />
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
                                                    <th class="text-center">Birthday</th>
                                                    <th class="text-center">Remaing Days</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $key => $emp)
                                                    @php
                                                        $currentYear = \Carbon\Carbon::now()->format('Y');
                                                        $today = \Carbon\Carbon::today();
                                                        $bday = \Carbon\Carbon::parse($emp->date_of_birth)->year($currentYear);

                                                        $remainingDays = $today->diffInDays($bday, false);
                                                    @endphp
                                                    <tr class="@if ($remainingDays == 0) success @endif">
                                                        <td class="text-center">{{ $key + 1 }}</td>

                                                        <td class="text-center">
                                                            <a href="{{ route('edit-emp', $emp->user->id) }}">{{ $emp->name }}
                                                            </a>
                                                        </td>

                                                        <td class="text-center">
                                                            {{ $bday->format('d-M-Y') }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $remainingDays }} days left until their birthday
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    {!! $employees->render() !!}
                                                </tr>
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
