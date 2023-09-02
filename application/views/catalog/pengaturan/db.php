<div class="content-wrapper">

  <div class="content">
    <?php
    echo $this->session->flashdata('msg');
    ?>

    <div class="row">
  
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h5 class="panel-title"><i class="fa fa-database" aria-hidden="true"></i> Backup Database</h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>
			<br />
		
			
		<div class="panel panel-flat col-md-4">
          <div class="panel-body">
		  <fieldset class="content-group">
           
              <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				Backup Database Aplikasi <strong><?php $configx = explode("#", configx()); echo $configx[0]; ?></strong>
				

            </fieldset>
            <div class="col-md-12">
              <button type="submit" name="btnbackup" class="btn btn-primary" style="float:right;" value="backup" onclick="return confirm('Backup Database Aplikasi ?')">Backup DB Now</button>
            </div>
          </form>
          </div>
		  </div>
		
			
        </div>

        <table class="table datatable-basic" width="100%">
          <thead>
            <tr>
              <th width="30px;">No.</th>
              <th>Backup Date</th>
			  <th>File DB</th>
              <th>User Backup</th>
              <th class="text-center" width="170"></th>
            </tr>
          </thead>
          <tbody>
              <?php
              $no = 1;
              foreach ($db as $baris) {
              ?>
                <tr>
                  <td><?php echo $no.'.'; ?></td>
                  <td><?php echo $baris->timeBackup; ?></td>
				  <td><?php echo $baris->fileBackup; ?> <a href="<?php echo base_url();?>backup/<?php echo $baris->fileBackup; ?>"><span><small class="label label-success">Download</small></span></a></td>
                  <td><?php echo $baris->namaLengkap; ?> (NIP: <?php echo $baris->nip; ?>) </td>
                   <td>
                    <a href="ketatausahaan/backupdb/h/<?php echo $baris->id; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                  </td>
                </tr>
              <?php
              $no++;
              } ?>
          </tbody>
        </table>
      </div>

    </div>

