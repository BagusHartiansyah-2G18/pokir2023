@extends('Dashboard.master')
@section('title', 'Dashboard')
@section('logo', 'account binfo clight fz25')
@section('page', 'Akun')
@section('pageDetail', 'Fitur update password')
@section('form')
	<div class="flexC"> 
		@if(count($dt['users'])>0)	 
			<div class="formActionLeft" id="formActionLeft">
				<div class="form2 mw640px">
					<div class="header binfo clight">
						<div class="icon">
							<span class="mdi mdi-claccount fz25"></span>
							<h3 class="">Daftar Pengguna</h3>
						</div>
						<button class="btn2 blight" onclick="_addForm()">Form Entri</button>
					</div>
					<div class="w95p  m0auto mwrap" id="viewData">
						
					</div>
				</div>
				<div class="updGrid2to1 dnone" id="itemFormLeft"></div>
			</div>
		@endif

		<div class="form2 mw640px">
			<div class="header binfo clight">
				<div class="icon">
					<span class="mdi mdi-claccount fz25"></span>
					<h3 class="">Perbarui Password</h3>
				</div>
			</div>
			<div class="m0auto w50p mw500px wblock mwrap">
				<div class="mtb10px">
					<div class="iconInput1 mtb10px ">
						<input class="borderR10px" type="password" id="passO" placeholder="Oll Password" />
						<span class="mdi mdi-key"></span>
					</div>
					<div class="iconInput1 mtb10px ">
						<input class="borderR10px" type="password" id="passN" placeholder="New Password" />
						<span class="mdi mdi-key-outline "></span>
					</div>
					<button class="btn2 bwarning" onclick="updPass()">Perbarui</button>
				</div>
			</div>
		</div>
	</div>
@endsection