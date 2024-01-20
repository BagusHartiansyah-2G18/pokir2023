@extends('Dashboard.master')
@section('title', 'Dashboard')
@section('logo', 'database-search bdark cwarning')
@section('page', 'kamus Usulan')
@section('pageDetail', 'Daftar usulan yang diijinkan')
@section('form')
	<div class="flexC">
		<div class="formActionLeft" id="formActionLeft">
			<div class="form2 ">
				<div class="header bdark cwarning">
					<div class="icon">
						<span class="mdi mdi-database-search fz25"></span>
						<h3 class="">Data Kamus Usulan</h3>
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
