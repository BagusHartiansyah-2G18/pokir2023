@extends('Dashboard.master')
@section('title', 'Dashboard')
@section('logo', 'apps')
@section('page', 'Dashboard')
@section('pageDetail', 'ringkasan data pada sistem')
@section('form')
	<div class="flexC">
		<div class="flexR3 mwrap">
			<div class="form0">
				<div class="ribbon ribbon-center ribbon-primary">
					<span class="bprimary">Grafik Keuangan</span>
				</div>
				<div class="w95p">
					<div id="chartContainer1" style="height: 370px; max-width: 100%; margin: 0px auto;"></div>
				</div>
			</div>
			<div class="form0">
				<div class="ribbon ribbon-center ribbon-danger">
					<span class="bdanger">Grafik Usulan</span>
				</div>
				<div class="w95p">
					<div id="chartContainer2" style="height: 370px; max-width: 100%; margin: 0px auto;"></div>
				</div>
			</div>
		</div>
	</div>
@endsection