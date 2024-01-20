@extends('Dashboard.master')
@section('title', 'Dashboard')
@section('logo', 'map-marker-path bdark csuccess')
@section('page', 'Data Lingkungan')
@section('pageDetail', 'Informasi Lingkungan yang telah diverifikasi')
@section('form')
	<div class="flexC">
		<div class="formActionLeft" id="formActionLeft">
			<div class="form2 ">
				<div class="header bdark csuccess">
					<div class="icon">
						<span class="mdi mdi-map-marker-path fz25"></span>
						<h3 class="">Data Lingkungan</h3>
					</div>
					@if($dt['level']>5)
						<button class="btn2 blight" onclick="_addForm()">Form Entri</button>
					@endif
				</div>
				<div class="w95p m0auto mwrap" id="viewData"></div>
			</div>
			<div class="updGrid2to1 dnone" id="itemFormLeft"></div>
		</div>
	</div>
@endsection
