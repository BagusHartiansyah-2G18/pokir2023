@extends('Dashboard.master')
@section('title', 'Dashboard')
@section('logo', 'clipboard-list')
@section('page', 'Daftar Usulan')
@section('pageDetail', 'Daftar perencanaan usulan')
@section('form')
	<div class="flexC">
        <div class="flexR jcSB" style="justify-content: space-between;">
            @if($dt['act'])
                <button class="btn2 bsuccess cwhite" onclick="_export()">Ajukan Munuju Tahapan Selanjutnya</button>
            @endif
            <button class="btn2 bsuccess cwhite" onclick="_pdf()">Laporan PDF</button>
        </div>
		<div class="formActionLeft" id="formActionLeft">
			<div class="form2 ">
				<div class="header bdark csuccess">
					<div class="icon">
						<span class="mdi mdi-clipboard-list fz25"></span>
						<h3 class="">Data Usulan</h3>
					</div>
					<div id="fbtnAdd">
					</div>
				</div>
				<div id="viewInfo" class="w95p m0auto mwrap"></div>
				<hr>
				<div class="w95p m0auto mwrap" id="viewData"></div>
			</div>
			<div class="updGrid2to1 dnone" id="itemFormLeft"></div>
		</div>
	</div>
@endsection
