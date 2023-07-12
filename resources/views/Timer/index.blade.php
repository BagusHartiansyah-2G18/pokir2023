@extends('Dashboard.master')
@section('title', 'Dashboard')
@section('logo', 'clock-time-eight-outline bprimary clight fz25')
@section('page', 'Timer')
@section('pageDetail', 'Menjadwalkan batas waktu penginputan')
@section('form')
	<div class="flexC"> 
		<div class="formActionLeft" id="formActionLeft">
			<div class="form2 ">
				<div class="header bprimary clight">
					<div class="icon">
						<span class="mdi mdi-clock-edit-outline fz25"></span>
						<h3 class="">Daftar Timer</h3>
					</div>
					<button class="btn2 blight" onclick="_addForm()">Form Entri</button>
				</div>
				<div class="w95p m0auto mwrap" id="viewData"></div>
			</div>
			<div class="updGrid2to1 dnone" id="itemFormLeft"></div>
		</div>
	</div>
@endsection