<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Mengelola Materi
		<small>Mengelola Materi berdasarkan modul dan topik</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url() ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Materi</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-xs-3">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="box-title">Pilih Modul / Topik</div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="form-group">
                            <label>Modul</label>
                            <div id="data-kelas">
                                <select name="modul" id="modul" class="form-control input-sm">
                                    <?php if(!empty($select_modul)){ echo $select_modul; } ?>
                                </select>
                            </div>
                        </div>
						<div class="form-group">
                            <label>Topik</label>
                            <div id="data-kelas">
                                <select name="topik" id="topik" class="form-control input-sm">
                                    <option value="kosong">Pilih Topik</option>
                                </select>
                            </div>
                            <small>Pilih modul dan topik terlebih dahulu sebelum menambah atau mengubah soal</small>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" id="btn-pilih" class="btn btn-primary pull-right">Pilih</button>
                    </div>
                </div>
        </div>

        <div class="col-xs-9">
                <div class="box">
                    <?php echo form_open_multipart($url.'/tambah','id="form-tambah" class="form-horizontal"'); ?>
                        <div class="box-header with-border">
                            <div class="box-title">Mengelola Materi <span id="judul-tambah-materi"></span></div>
                        </div><!-- /.box-header -->

                        <div class="box-body">
                            <div id="form-pesan"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Materi</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="tambah-topik-id" id="tambah-topik-id" >
                                    <input type="hidden" name="tambah-soal-id" id="tambah-soal-id" >
                                    <input type="hidden" name="tambah-materi" id="tambah-materi" >
                                    <textarea class="textarea" id="tambah_materi" name="tambah_materi" style="width: 100%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    <p class="help-block">Jelaskan menerangkan judul materi.</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">File Materi</label>
                                <div class="col-sm-10">
                                    <input type="file" id="tambah-file" name="tambah-file" >
                                    <p class="help-block">File Materi yang akan ditambah pada bagian Topik ( hanya file pdf)</p>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" id="tambah-simpan" class="btn btn-primary pull-right">Simpan</button>
                        </div>
                    </form>
                </div>


                <div class="box">
                    <div class="box-header with-border">
    						<div class="box-title">Daftar Materi <span id="judul-daftar-materi"></span></div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <table id="table-soal" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama File</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
									<td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>                        
                    </div>
                </div>
        </div>
    </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-soal').dataTable().fnReloadAjax();
    }
	
	function refresh_topik(){
        var modul_id = $('#modul').val();
		$.getJSON('<?php echo site_url().'/'.$url; ?>/get_topik_by_modul/'+modul_id, function(data){
            var $topik = $('#topik');
            $topik.empty();
            if(data.data==1){
                $.each(data.topik, function(key, val){
                    $topik.append('<option value="' + val.id + '">' + val.topik +'</option>');
                });
            }else{
				$topik.append('<option value="kosong">Tidak Ada Topik</option>');
			}
        });
	}

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#edit-id').val(data.id);
                $('#edit-topik').val(data.topik);
                $('#edit-topik-asli').val(data.topik);
                $('#edit-deskripsi').val(data.deskripsi);
                
                $("#modal-edit").modal("show");
            }
            $("#modal-proses").modal('hide');
        });
    }

    /**
     * Fungsi untuk upload image dari summernote
     */
    function imageUpload(){
        $("#modal-image").modal("show");
    }

    $(function(){
        refresh_topik();

        $("#modul").change(function(){
            refresh_topik();
        });

        $("#btn-pilih").click(function(){
            $("#modal-proses").modal('show');
            $('#judul-tambah-soal').html($('#topik option:selected').text());
            $('#judul-daftar-soal').html($('#topik option:selected').text());
            $('#tambah-topik-id').val($('#topik').val());
            refresh_table();
            $("#modal-proses").modal('hide');
        });

        $('#btn-image').click(function(){
            $("#tambah-soal").summernote('pasteHTML', '<img src="http://localhost/cbt/uploads//boss.jpg" style="max-width:300px;" />');
            $("#modal-image").modal("hide");
        });

        $('#form-tambah').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah",
                    type:"POST",
                    data:new FormData(this),
                    mimeType: "multipart/form-data",
                    contentType:false,
                    cache: false,
                    processData: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#form-pesan").html('');
                            $("#tambah-soal").summernote('code', '');
                            $('#tambah-tipe').val('1');
                            $('#tambah-putar').val('1');
                            $('#tambah-audio').val('');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });
		 
		$( document ).ready(function() {
            $('#table-soal').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "topik", "value": $('#topik').val()} );
                  }
            });

		});
    });
</script>