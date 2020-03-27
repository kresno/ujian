<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?php if(!empty($site_name)){ echo $site_name; } ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/manager"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-success box-solid">
		<div class="box-header with-border">
        	<h3 class="box-title">Petunjuk Penggunaan</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        	<dl>
        		<dt>Data Modul</dt>
                <dd>
                	Kelompok Data Modul digunakan untuk menambah modul, topik, dan soal. Serta digunakan untuk mengatur file dengan memanfaatkan File Manager.
                	<ol>
                		<li>Modul</li>
                		<li>Topik</li>
                		<li>Soal</li>
                		<li>Import Soal</li>
                		<li>Daftar Soal</li>
                		<li>File Manager</li>
                	</ol>
                </dd>
                <dt>Data Peserta</dt>
                <dd>
                	Kelompok Data Peserta digunakan untuk mengatur Peserta, dan Group.
                	<ol>
                		<li>Daftar Group</li>
                		<li>Daftar Peserta</li>
                		<li>Import Data Peserta</li>
                	</ol>
                <dt>Data Tes</dt>
                <dd>
                	Kelompok Data Tes digunakan untuk mengatur Tes, mengevaluasi jawaban essay, dan melihat Hasil tes.
                	<ol>
                		<li>Tambah Tes</li>
                		<li>Daftar Tes</li>
                		<li>Evaluasi Tes</li>
                		<li>Hasil tes</li>
                        <li>Rekap Hasil Tes</li>
                		<li>Token</li>
                	</ol>
                </dd>
                <dt>Tool</dt>
                <dd>
                    Kelompok Tool digunakan untuk membackup database, file pedukung soal, dan Export Import Data Soal
                    <ol>
                        <li>Backup Data</li>
                        <li>Export Import Soal</li>
                    </ol>
                </dd>
            </dl>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->