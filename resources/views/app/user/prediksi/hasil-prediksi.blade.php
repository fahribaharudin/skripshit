@extends('layouts.dashboard')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include ('app.partials.sidebar-user')
			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header" style="margin-top: 0">
							<h3>Hasil Prediksi Kelulusan Dengan Perhitungan NBC</h3>
						</div>
						<div class="well">
							<p>
								Perhitungan Naive Bayes Classifier (NBC) pada aplikasi prediksimu bisa di ilustrasikan menggunakan flowchart sebagai berikut:
							</p>
							<hr>
							<div class="row">
								<div class="col-md-5">
									<img src="{{ asset('img/flowchart-perhitungan-nbc.png') }}" width="100%">
								</div>
								<div class="col-md-7">
									<p class="small">Penjelasan flowchart di samping adalah sebagai berikut:</p>
									<ol class="small" style="padding-left: 15px">
										<li>
											Data kuisioner yang anda masukan sebelumnya akan di terjemahkan oleh sistem menjadi sebuah dokumen test lalu di simpan ke dalam database
										</li>
										<li>
											Selanjutnya menghitung jumlah kelas berdasarkan klasifikasi yang terbentuk (prior probability / P(Ci))
										</li>
										<li>
											Selanjutnya menghitung jumlah kasus yang sama pada setiap attribut dari kelas yang terbentuk (Lulus tepat waktu / Tidak tepat waktu) berdasarkan dokumen test (conditional probabilities / P(X|Ci)) terhadap dokumen learning (hasil kuisioner orang lain yang juga sudah di simpan di database).
										</li>
										<li>
											Selanjutnya diperoleh dua hasil yaitu (P(X|C1) = 'Lulus tepat waktu') dan (P(X|C2) = 'Tidak tepat waktu'). Perhitungan ini dilakukan dengan mengalikan P(Ci) dengan P(X|Ci) untuk setiap attribut (pertanyaan pada kuisioner yang telah anda isi sebelumnya).
										</li>
										<li>
											Dari hasil tersebut lalu dilakukan penyimpulan keputusan oleh sistem di mana sistem nantinya akan memutuskan apakah anda masuk ke dalam kelompok (C1 = 'Lulus tepat waktu') atau (C2 = 'Tidak tepat waktu') dengan mengambil hasil perhitungan terbesar atau yang lebih dominan.
										</li>
									</ol>
								</div>
							</div>
						</div>
						<h4>Hasil Perhitungan:</h4>
						<ol>
							<li>
								Prior probability / P(Ci) untuk setiap kelas:
								<ul>
									<li>P (Tepat Waktu): <span class="label label-default">{{ $hasilPrediksi['P(class) / priors']['P(Tepat waktu)'] }}</span></li>
									<li>P (Tidak tepat Waktu): <span class="label label-default">{{ $hasilPrediksi['P(class) / priors']['P(Terlambat)'] }}</span></li>
									<br>
									<p class="small text-info well">
										<strong>Catatan:</strong> hasil perhitungan ini menunjukan keseimbangan probability antar kelas yang terdapat pada dokumen learning yang di gunakan oleh sistem, dokumen learning adalah hasil kuisioner milik semua user yang terdaftar pada aplikasi Prediksimu
									</p>
								</ul>
								<br>
							</li>
							<li>
								P(X|Ci) untuk setiap attribut:
								<ul>
									<li>
										P(X|Tepat waktu):
										<ul>
											<li>
												Jumlah organisasi yang anda ikuti:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(jumlah_organisasi|Terlambat)'] < $hasilPrediksi['conditional probabilities']['P(jumlah_organisasi|Tepat waktu)'] ? 'success' : 'warning' }}">
										{{ $hasilPrediksi['conditional probabilities']['P(jumlah_organisasi|Tepat waktu)'] }}
									</span>
											</li>
											<li>
												Waktu berorganisasi yang anda gunakan dalam sehari:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(waktu_berorganisasi|Terlambat)'] < $hasilPrediksi['conditional probabilities']['P(waktu_berorganisasi|Tepat waktu)'] ? 'success' : 'warning' }}">
										{{ $hasilPrediksi['conditional probabilities']['P(waktu_berorganisasi|Tepat waktu)'] }}
									</span>
											</li>
											<li>
												Kaitan antara anda sudah melakukan KP atau KPM:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(sudah_kp_atau_kpm|Terlambat)'] < $hasilPrediksi['conditional probabilities']['P(sudah_kp_atau_kpm|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(sudah_kp_atau_kpm|Tepat waktu)'] }}</span>
											</li>
											<li>
												Kaitan antara adanya event organisasi yang di selengarakan oleh organisasi anda di kampus tiap semesternya:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(event_organisasi_tiap_semester|Terlambat)'] < $hasilPrediksi['conditional probabilities']['P(event_organisasi_tiap_semester|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(event_organisasi_tiap_semester|Tepat waktu)'] }}</span>
											</li>
											<li>
												Keikut sertaan anda dalam menjadi panitia dalam event organisasi tersebut:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(jadi_panitia|Terlambat)'] < $hasilPrediksi['conditional probabilities']['P(jadi_panitia|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(jadi_panitia|Tepat waktu)'] }}</span>
											</li>
											<li>
												Adanya mata kuliah anda yang belum tuntas:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(makul_belum_tuntas|Terlambat)'] < $hasilPrediksi['conditional probabilities']['P(makul_belum_tuntas|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(makul_belum_tuntas|Tepat waktu)'] }}</span>
											</li>
											<li>
												Jumlah SKS anda yang sudah mencukupi untuk melakukan KP atau KPM (ketika anda sudah mampu melakukan KP / KPM tentu saja seharusnya anda juga sudah bisa mengajukan judul skripsi ke dosen anda)
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(sks_cukup|Terlambat)'] < $hasilPrediksi['conditional probabilities']['P(sks_cukup|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(sks_cukup|Tepat waktu)'] }}</span>
											</li>
											<li>
												Keinginan anda untuk lulus tepat waktu:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(ingin_lulus_tepat_waktu|Terlambat)'] < $hasilPrediksi['conditional probabilities']['P(ingin_lulus_tepat_waktu|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(ingin_lulus_tepat_waktu|Tepat waktu)'] }}</span>
											</li>
										</ul>
										<br>
										<p class="small text-info well">
											<strong>Catatan:</strong> warna hijau menunjukan hasil yang lebih dominan, sedangkan warnan kuning menunjukan sebaliknya.
										</p>
									</li>
									<br>
									<li>
										P(X|Tidak tepat waktu):
										<ul>
											<li>
												Jumlah organisasi yang anda ikuti:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(jumlah_organisasi|Terlambat)'] >= $hasilPrediksi['conditional probabilities']['P(jumlah_organisasi|Tepat waktu)'] ? 'success' : 'warning' }}">
										{{ $hasilPrediksi['conditional probabilities']['P(jumlah_organisasi|Terlambat)'] }}
									</span>
											</li>
											<li>
												Waktu berorganisasi yang anda gunakan dalam sehari:
												<span  class="label label-{{ $hasilPrediksi['conditional probabilities']['P(waktu_berorganisasi|Terlambat)'] > $hasilPrediksi['conditional probabilities']['P(waktu_berorganisasi|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(waktu_berorganisasi|Terlambat)'] }}</span>
											</li>
											<li>
												Kaitan antara anda sudah melakukan KP atau KPM:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(sudah_kp_atau_kpm|Terlambat)'] > $hasilPrediksi['conditional probabilities']['P(sudah_kp_atau_kpm|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(sudah_kp_atau_kpm|Terlambat)'] }}</span>
											</li>
											<li>
												Kaitan antara adanya event organisasi yang di selengarakan oleh organisasi anda di kampus tiap semesternya:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(event_organisasi_tiap_semester|Terlambat)'] > $hasilPrediksi['conditional probabilities']['P(event_organisasi_tiap_semester|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(event_organisasi_tiap_semester|Terlambat)'] }}</span>
											</li>
											<li>
												Keikut sertaan anda dalam menjadi panitia dalam event organisasi tersebut:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(jadi_panitia|Terlambat)'] > $hasilPrediksi['conditional probabilities']['P(jadi_panitia|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(jadi_panitia|Terlambat)'] }}</span>
											</li>
											<li>
												Adanya mata kuliah anda yang belum tuntas:
												<span class="label label-{{ $hasilPrediksi['conditional probabilities']['P(makul_belum_tuntas|Terlambat)'] > $hasilPrediksi['conditional probabilities']['P(makul_belum_tuntas|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(makul_belum_tuntas|Terlambat)'] }}</span>
											</li>
											<li>
												Jumlah SKS anda yang sudah mencukupi untuk melakukan KP atau KPM (ketika anda sudah mampu melakukan KP / KPM tentu saja seharusnya anda juga sudah bisa mengajukan judul skripsi ke dosen anda)
												<span  class="label label-{{ $hasilPrediksi['conditional probabilities']['P(sks_cukup|Terlambat)'] > $hasilPrediksi['conditional probabilities']['P(sks_cukup|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(sks_cukup|Terlambat)'] }}</span>
											</li>
											<li>
												Keinginan anda untuk lulus tepat waktu:
												<span  class="label label-{{ $hasilPrediksi['conditional probabilities']['P(ingin_lulus_tepat_waktu|Terlambat)'] > $hasilPrediksi['conditional probabilities']['P(ingin_lulus_tepat_waktu|Tepat waktu)'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['conditional probabilities']['P(ingin_lulus_tepat_waktu|Terlambat)'] }}</span>
											</li>
										</ul>
										<br>
										<p class="small text-info well">
											<strong>Catatan:</strong> warna hijau menunjukan hasil yang lebih dominan, sedangkan warnan kuning menunjukan sebaliknya.
									</li>
								</ul>
							</li>
							<br>
							<li>
								Hasil setelah semua attribut dikalikan dengan Prior Probability
								<ul>
									<li>
										(P(X|C1) = 'Lulus tepat waktu'):
										<span class="label label-{{ $hasilPrediksi['P(X|class)']['Tepat waktu'] > $hasilPrediksi['P(X|class)']['Terlambat'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['P(X|class)']['Tepat waktu'] }}</span>
									</li>
									<li>
										(P(X|C2) = 'Tidak tepat waktu'):
										<span class="label label-{{ $hasilPrediksi['P(X|class)']['Tepat waktu'] < $hasilPrediksi['P(X|class)']['Terlambat'] ? 'success' : 'warning' }}">{{ $hasilPrediksi['P(X|class)']['Terlambat'] }}</span>
									</li>
									<br>
									<p class="small text-info well">
										<strong>Catatan:</strong> hasil ini secara tidak langsung dipengaruhi oleh jumlah dominansi attribut - attribut yang ada pada P(X|Ci), anda bisa mengefaluasi kegiatan keorganisasian anda sesuai dengan hasil yang di tunjukan di atas sehingga waktu kelulusan anda bisa sesuai harapan anda.
								</ul>
							</li>
							<br>
							<li>
								Kesimpulanya: <br>
								Dari hasil tersebut anda diprediksi lulus {{ $hasilPrediksi['hasil'] }}
							</li>
						</ol>
					</div>
					<div class="panel-footer">
						<a href="{{ url('home') }}" class="btn btn-lg btn-success">Simpan Hasil >></a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection