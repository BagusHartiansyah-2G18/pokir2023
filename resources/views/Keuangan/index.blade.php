@extends('Dashboard.master')
@section('title', 'Dashboard')
@section('logo', 'currency-usd bsuccess clight')
@section('page', 'keuangan')
@section('pageDetail', 'Informasi transaksi dan sumber keuangan')
@section('form')
	<div class="flexC"> 
		<div class="formActionLeft" id="formActionLeft">
			<div class="form2 ">
				<div class="header bsuccess clight">
					<div class="icon">
						<span class="mdi mdi-currency-usd fz25"></span>
						<h3 class="">Daftar keuangan</h3>
					</div>
					<div class="btnGroup">
						<!-- @if($dt['level']==3)
							<button class="btn2 bprimary clight" onclick="_addFormEntri()">Form Entri</button>
						@endif -->
						<div id="fbtnAdd">
							<!-- <button class="btn2 blight" onclick="_addFormEntri()">Form Transfer</button> -->
						</div>
					</div>
				</div>
				<div class="w95p m0auto mwrap" id="viewData"></div>
			</div>
			<div class="updGrid2to1 dnone" id="itemFormLeft"></div>
		</div>
	</div>
@endsection